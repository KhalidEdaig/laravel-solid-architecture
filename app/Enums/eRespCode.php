<?php

namespace App\Enums;

abstract class eRespCode
{
    // Common
    const _403_NOT_AUTHORIZED = ['403_00' => 'Not Authorized'];
    const _400_BAD_REQUEST = ['400_00' => 'Bad Request'];
    const _500_INTERNAL_ERROR = ['500_00' => 'Internal Error'];
    const _520_UNKNOWN_ERROR = ['520_00' => 'Unknown Error'];
    const _200_OK = ['200_00' => 'OK'];
    const _404_NOT_FOUND = ['404_00' => 'Not Found'];
    const _422_VALIDATION_FAILED = ['422_00' => 'validation failed'];

     // User
    // 200
    const U_LISTED_200_00 = ['U200_00' => 'Users succesfully listed !'];
    const U_UPDATED_200_01 = ['U200_01' => 'User succesfully updated !'];
    const U_DELETED_200_02 = ['U200_02' => 'User succesfully deleted !'];
    const U_GET_200_03 = ['U200_03' => 'User succesfully retreived !'];
    // 201
    const U_CREATED_201_00 = ['U201_00' => 'User succesfully created !'];

    // Company

    // 200
    const C_LISTED_200_00 = ['C200_00' => 'Companies succesfully listed !'];
    const C_UPDATED_200_01 = ['C200_01' => 'Company succesfully updated !'];
    const C_DELETED_200_02 = ['C200_02' => 'Company succesfully deleted !'];
    const C_GET_200_03 = ['C200_03' => 'Company succesfully retreived !'];
    // 201
    const C_CREATED_201_00 = ['C201_00' => 'Company succesfully created !'];
    // 404
    const C_NOT_FOUND_404_00 = ['C404_00' => 'Company not found !'];

    // Employee

    // 200
    const EMP_LISTED_200_00 = ['EMP200_00' => 'Employees succesfully listed !'];
    const EMP_UPDATED_200_01 = ['EMP200_01' => 'Employee succesfully updated !'];
    const EMP_DELETED_200_02 = ['EMP200_02' => 'Employee succesfully deleted !'];
    const EMP_GET_200_03 = ['EMP200_03' => 'Employee succesfully retreived !'];
    // 201
    const EMP_CREATED_201_00 = ['EMP201_00' => 'Employee succesfully created !'];



    const F_UPLOADED_201_00 = ['F201_00' => 'file succesfully uploaded !'];

  

    static function getAllEResp()
    {
        $Class = new \ReflectionClass(__CLASS__);
        return $Class->getConstants();
    }
}
