<?php

namespace Stelin\Response\Model;

class Profile
{
    public $dateCreated;
    public $dateUpdated;
    public $status;
    public $createdBy;
    public $updatedBy;
    public $fullName;
    public $nickName;
    public $deviceId;
    public $lockStatus;
    public $type;
    public $level;
    public $state;
    public $ktpCard;
    public $lmpCard;
    public $passport;
    public $document;
    public $refNo;
    public $userLevel;
    public $ovoId;
    public $dateOfBirth;
    public $address;

    /**
     * telephones
     *
     * @var array
     */
    public $telephones;
    public $emails;
    public $cards;
    public $macAddress;
    public $drivers;
    public $ovoCard;
    public $organization;
    public $bonus;
    public $mobilePhoneNumber;
    public $email;
    public $registrationOrigin;
    public $dateOnUpgrade;
    public $birthPlace;
    public $religion;
    public $nationality;
    public $npwpCard;
    public $company;
    public $family;
    public $occupation;
    public $motherMaidenName;
    public $correspondenceType;
    public $cif;
    public $firstSignIn;
    public $lastSignIn;
    public $camId;
    /**
     * devices
     *
     * @var array
     */
    public $devices;
    /**
     * boltDevices
     *
     * @var array
     */
    public $boltDevices;
    public $isVeirfy;
    public $verifyDate;
    /**
     * LinkedMerchants
     *
     * @var array
     */
    public $LinkedMerchants;
    public $investment;
    public $camInvestment;
    public $bankAccount;
    public $savingAccount;
    /**
     * badges
     *
     * @var array
     */
    public $badges;
    public $kycweb;
    public $gender;
    public $maritalStatus;
    public $isEmailVerified;
    public $isPhoneVerified;
    public $isSecurityCodeSet;
    public $loyaltyId;
    public $eMoneyId;
    public $eMoneyOvoId;
    /**
     * config
     *
     * @var array
     */
    public $config;

    public function __construct($data)
    {
        $key = array_keys((array)$data);
        for ($i = 0; $i < count($key); $i++) {
            $keyPriv = $key[$i];
            $this->$keyPriv = ((array)$data)[$key[$i]];
        }
    }
}
