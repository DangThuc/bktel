<?php

namespace App\Imports;

use App\Models\Sinhvien;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;


class SinhviensImport implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {   
        foreach ($rows as $row ) {
            $sinhvien = new sinhvien();
            $sinhvien->Firstname = $row[0];
            $sinhvien->Lastname = $row[1];
            $sinhvien->Studentcode = $row[2];
            $sinhvien->Department = $row[3];
            $sinhvien->Faculty = $row[4];
            $sinhvien->Address = $row[5];
            $sinhvien->Phone = $row[6];
            $sinhvien->Note = $row[7];
        
            $sinhvien->save();

            $user = new User();
            $user->name = $row[0]." ".$row[1];
            $user->email = $row[2];
            $user->password = Hash::make($row[9]);
            $user->role_id = 4;
            $user->sinhvien_id = $sinhvien->id;
            $user->save();
        }
    }
}
