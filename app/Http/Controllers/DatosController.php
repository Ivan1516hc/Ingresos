<?php

namespace App\Http\Controllers;


use App\Models\Promoter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatosController extends Controller
{
    protected function convertValuesToUppercase($data, $keyToExclude)
    {
        $convertedData = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $convertedData[$key] = $this->convertValuesToUppercase($value, $keyToExclude);
            } elseif ($key === $keyToExclude || (is_numeric($value) && $value !== 0)) {
                $convertedData[$key] = $value;
            } elseif (empty($value) && $value !== 0) {
                $convertedData[$key] = null;
            } else {
                $convertedData[$key] = trim(mb_strtoupper($value));
            }
        }

        return $convertedData;
    }

    public function departments()
    {
        $keyToExclude = ['pwd'];
        $departments = DB::connection('mysql_2')->table("departamento")->get();
        foreach ($departments as $department) {
            $department = $this->convertValuesToUppercase($department, $keyToExclude);
            DB::table('departments')->insert([
                'id'         => $department['id'],
                'level'      => $department['nivel'],
                'name'       => $department['nombre'],
                'direction'  => $department['direccion'],
                'dependence' => $department['depende'],
                'created_at' => Carbon::now(),
            ]);
        }

        $profiles = DB::connection('mysql_2')->table("perfiles")->get();
        foreach ($profiles as $profile) {
            $profile = $this->convertValuesToUppercase($profile, $keyToExclude);
            DB::table('profiles')->insert([
                'id'        => $profile['idperfiles'],
                'name'      => $profile['nombrePerfil'],
                'created_at' => Carbon::now(),
            ]);
        }

        $groups = DB::connection('mysql_2')->table("grupos")->get();
        foreach ($groups as $group) {
            $group = $this->convertValuesToUppercase($group, $keyToExclude);
            DB::table('groups')->insert([
                'id'        => $group['activo'],
                'name'      => $group['nombre'],
                'created_at' => Carbon::now(),
            ]);
        }

        $locations = DB::connection('mysql_2')->table("ubicacion")->get();
        foreach ($locations as $location) {
            $location = $this->convertValuesToUppercase($location, $keyToExclude);
            DB::table('locations')->insert([
                'id'            => $location['idubicacion'],
                'name'          => $location['ubicacion'],
                'descripcion'   => $location['Nombre'],
                'group_id'      => $location['grupo'],
                'created_at'    => Carbon::now(),
                // 'manager_id' => $location->responsable
            ]);
        }

        $users = DB::connection('mysql_2')->table("user")->get();
        foreach ($users as $user) {
            $user = $this->convertValuesToUppercase($user, $keyToExclude);
            DB::table('users')->insert([
                'id'          => $user['iduser'],
                'username'    => $user['usr'],
                'password'    => Hash::make($user['pwd']),
                'name'        => $user['nombre'],
                'post'        => $user['puesto'],
                'profile_id'  => $user['perfil'],
                'location_id' => $user['idubicacion'],
                'created_at' => Carbon::now(),
            ]);
        }

        $therapists = DB::connection('mysql_2')->table("terapeutas")->get();
        foreach ($therapists as $therapist) {
            $therapist = $this->convertValuesToUppercase($therapist, $keyToExclude);
            DB::table('therapists')->insert([
                'id'  => $therapist['idterapeutas'],
                'name'  => $therapist['nombre'],
                'created_at' => Carbon::now(),
            ]);
        }

        $promoters = DB::connection('mysql_2')->table("promotores")->get();
        foreach ($promoters as $promoter) {
            $promoter = $this->convertValuesToUppercase($promoter, $keyToExclude);
            DB::table('promoters')->insert([
                'id'  => $promoter['idpromotores'],
                'name'  => $promoter['nombre'],
                'created_at' => Carbon::now(),
            ]);
        }

        $services = DB::connection('mysql_2')->table("productos")->get();
        foreach ($services as $service) {
            $service = $this->convertValuesToUppercase($service, $keyToExclude);
            DB::table('services')->insert([
                'id'            => $service['idproductos'],
                'name'          => $service['descripcion'],
                'cost'          => $service['costo'],
                'type_income'   => $service['tingreso'] ?? null,
                'code_income'   => $service['cingreso'] ?? null,
                'not_binding'   => $service['nv'],
                'id_gu'         => $service['idgu'],
                'partial'       => $service['parciales'],
                'unit'          => $service['unidad'],
                'leadership'    => $service['jefatura'],
                'created_at'    => Carbon::now(),
            ]);
        }

        $locations = DB::connection('mysql_2')->table("ubicacion")->select('idubicacion', 'responsable')->get();
        foreach ($locations as $location) {
            $location = $this->convertValuesToUppercase($location, $keyToExclude);
            DB::table('locations')->where('id', $location['idubicacion'])->update([
                'manager_id' => $location['responsable']
            ]);
        }

        $transactions = DB::connection('mysql_2')->table("productos")->get();
        foreach ($transactions as $transaction) {
            $transaction = $this->convertValuesToUppercase($transaction, $keyToExclude);
            $hellokyity = explode(',', $transaction['grupo']);
            foreach ($hellokyity as $hello) {
                DB::table('groups_services')->insert([
                    'group_id'  => $hello == '' ? 8 : $hello,
                    'service_id' => $transaction['idproductos'],
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $file = 'C:\Users\Humberto\Downloads\movimientos (2).csv';
        $headerMap = [
            'idventa' => 'invoice',
            'facturar' => 'bill',
            'total' => 'total',
            'idbeneficiario' => 'beneficiary_id',
            'nombrebeneficiario' => 'beneficiary_name',
            'idcentro' => 'location_id',
            'idUser' => 'user_id',
            'estatus' => 'status',
            'fecha' => 'created_at',
        ];
        $ignoredColumns = [
            'idMovimientos', 'idFolio',
            'idCaja', 'cantidad', 'costo', 'pdescuento', 'iddescuento', 'terapeuta',
            'motivocancela', 'centroalim', 'idProducto', 'parcial'
        ];

        if (($handle = fopen($file, "r")) !== false) {
            $header = fgetcsv($handle);
            $header = array_map(function ($column) use ($headerMap) {
                return isset($headerMap[$column]) ? $headerMap[$column] : $column;
            }, $header);

            while (($data = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $data);
                $data = array_filter($data, function ($key) use ($ignoredColumns) {
                    return !in_array($key, $ignoredColumns);
                }, ARRAY_FILTER_USE_KEY);
                // Check if a value exists and assign null if not
                foreach ($data as &$value) {
                    $value = $value === '' ? null : $value;
                }
                // Replace 'idUser' value if it is equal to 110
                if ($data['user_id'] === '110') {
                    $data['user_id'] = '109';
                }
                // Replace 'idcentro' value if it is equal to 74
                if ($data['location_id'] === '74') {
                    $data['location_id'] = '51';
                }
                // Save the processed data to the database
                DB::table('transactions')->insert($data);
            }
            fclose($handle);
        }
    }

    public function import()
    {
        $keyToExclude = ['pwd'];

        $cancellations = DB::connection('mysql_2')->table("movimientos")->where('estatus',3)->get();
        foreach ($cancellations as $cancellation) {
            $cancellation = $this->convertValuesToUppercase($cancellation, $keyToExclude);
                DB::table('cancellation_histories')->insert([
                    'transaction_id' => $cancellation['idventa'],
                    'user_id' => $cancellation['idUser'],
                    'created_at' => $cancellation['fecha'],
                ]);
        }

        $file2 = 'C:\Users\Humberto\Downloads\movimientos (3).csv';
        if (($handle = fopen($file2, "r")) !== false) {
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $data);
                // Check if a value exists and assign null if not
                foreach ($data as &$value) {
                    $value = $value === '' ? null : $value;
                }
                // Save the processed data to the database
                DB::table('services_transactions')->insert($data);
            }
            fclose($handle);
        }
    }

    public function reprintHistories()
    {
        $keyToExclude = ['pwd'];
        // $file4 = 'C:\Users\Humberto\Downloads\historialreimp.csv';
        // if (($handle = fopen($file4, "r")) !== false) {
        //     $header = fgetcsv($handle);

        //     while (($data = fgetcsv($handle)) !== false) {
        //         $data = array_combine($header, $data);

        //         // Check if a value exists and assign null if not
        //         foreach ($data as &$value) {
        //             $value = $value === '' ? null : $value;
        //         }
        //         // Save the processed data to the database
        //         DB::table('reprint_histories')->insert($data);
        //     }
        //     fclose($handle);
        // }
        $reprints = DB::connection('mysql_2')->table("historialreimp")->get();
        foreach ($reprints as $reprint) {
            $reprint = $this->convertValuesToUppercase($reprint, $keyToExclude);
                DB::table('reprint_histories')->insert([
                    'id'  => $reprint['idhistorialreimp'],
                    'transaction_id' => $reprint['idventa'],
                    'user_id' => $reprint['iduser'],
                    'created_at' => $reprint['fecha'],
                ]);
        }

        $partialPayments = DB::connection('mysql_2')->table("parcialidades")->get();
        foreach ($partialPayments as $partialPayment) {
            $partialPayment = $this->convertValuesToUppercase($partialPayment, $keyToExclude);
            DB::table('partial_payments')->insert([
                'beneficiary_id'  => $partialPayment['idBeneficiario'],
                'beneficiary_name'  => $partialPayment['nombreBeneficiario'],
                'service_id'  => $partialPayment['idProducto'],
                'user_id'  => $partialPayment['idUser'],
                'payment'  => $partialPayment['Abonado'],
                'partiality'  => $partialPayment['Numero'],
                'status'  => $partialPayment['Estatus'],
                'created_at'  => $partialPayment['Fec_ini'],
                'updated_at' => $partialPayment['Fec_Ult']
            ]);
        }
    }

    public function therapistsTransactions()
    {
        $keyToExclude = ['pwd'];
        $transactions_therapists = DB::connection('mysql_2')->table("movimientos")->select('idventa','terapeuta','fecha')->where('terapeuta','<>','')->first();
        dd($transactions_therapists);
        foreach ($transactions_therapists as $transaction_therapist) {
            $transaction_therapist = $this->convertValuesToUppercase($transaction_therapist, $keyToExclude);
            DB::table('therapists_transactions')->insert([
                'therapist_id'  => $transaction_therapist['terapeuta'],
                'transactions_id'  => $transaction_therapist['idventa'],
                'created_at'  => $transaction_therapist['fecha'],
            ]);
        }
    }
}
