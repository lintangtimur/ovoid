<?php
namespace Stelin\Response;

class C600
{
    /**
     * @var int
     */
    private $cardBalance;

    /**
     * @var string
     */
    private $cardNo;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @return int|null
     */
    public function getCardBalance(): ?int
    {
        return $this->cardBalance;
    }

    /**
     * @param int|null $cardBalance
     *
     * @return C600
     */
    public function setCardBalance(?int $cardBalance): C600
    {
        $this->cardBalance = $cardBalance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNo(): ?string
    {
        return $this->cardNo;
    }

    /**
     * @param string|null $cardNo
     *
     * @return C600
     */
    public function setCardNo(?string $cardNo): C600
    {
        $this->cardNo = $cardNo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     *
     * @return C600
     */
    public function setPaymentMethod(?string $paymentMethod): C600
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }
}

class C000
{
    /**
     * @var int
     */
    private $cardBalance;

    /**
     * @var string
     */
    private $cardNo;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @return int|null
     */
    public function getCardBalance(): ?int
    {
        return $this->cardBalance;
    }

    /**
     * @param int|null $cardBalance
     *
     * @return C000
     */
    public function setCardBalance(?int $cardBalance): C000
    {
        $this->cardBalance = $cardBalance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNo(): ?string
    {
        return $this->cardNo;
    }

    /**
     * @param string|null $cardNo
     *
     * @return C000
     */
    public function setCardNo(?string $cardNo): C000
    {
        $this->cardNo = $cardNo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     *
     * @return C000
     */
    public function setPaymentMethod(?string $paymentMethod): C000
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }
}

class C001
{
    /**
     * @var int
     */
    private $cardBalance;

    /**
     * @var string
     */
    private $cardNo;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @return int|null
     */
    public function getCardBalance(): ?int
    {
        return $this->cardBalance;
    }

    /**
     * @param int|null $cardBalance
     *
     * @return C001
     */
    public function setCardBalance(?int $cardBalance): C001
    {
        $this->cardBalance = $cardBalance;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardNo(): ?string
    {
        return $this->cardNo;
    }

    /**
     * @param string|null $cardNo
     *
     * @return C001
     */
    public function setCardNo(?string $cardNo): C001
    {
        $this->cardNo = $cardNo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     *
     * @return C001
     */
    public function setPaymentMethod(?string $paymentMethod): C001
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }
}

class Balance
{
    /**
     * @var C600
     */
    private $C600;

    /**
     * @var C000
     */
    private $C000;

    /**
     * @var C001
     */
    private $C001;

    /**
     * @return C600|null
     */
    public function get600(): ?C600
    {
        return $this->C600;
    }

    /**
     * @param C600|null $C600
     *
     * @return Balance
     */
    public function set600(?C600 $C600): Balance
    {
        $this->C600 = $C600;

        return $this;
    }

    /**
     * @return C000|null
     */
    public function get000(): ?C000
    {
        return $this->C000;
    }

    /**
     * @param C000|null $C000
     *
     * @return Balance
     */
    public function set000(?C000 $C000): Balance
    {
        $this->C000 = $C000;

        return $this;
    }

    /**
     * @return C001|null
     */
    public function get001(): ?C001
    {
        return $this->C001;
    }

    /**
     * @param C001|null $C001
     *
     * @return Balance
     */
    public function set001(?C001 $C001): Balance
    {
        $this->C001 = $C001;

        return $this;
    }
}

class ChildMenu
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $menuName;

    /**
     * @var string
     */
    private $isEnabled;

    /**
     * @var int
     */
    private $state;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return ChildMenu
     */
    public function setId(?int $id): ChildMenu
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMenuName(): ?string
    {
        return $this->menuName;
    }

    /**
     * @param string|null $menuName
     *
     * @return ChildMenu
     */
    public function setMenuName(?string $menuName): ChildMenu
    {
        $this->menuName = $menuName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsEnabled(): ?string
    {
        return $this->isEnabled;
    }

    /**
     * @param string|null $isEnabled
     *
     * @return ChildMenu
     */
    public function setIsEnabled(?string $isEnabled): ChildMenu
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getState(): ?int
    {
        return $this->state;
    }

    /**
     * @param int|null $state
     *
     * @return ChildMenu
     */
    public function setState(?int $state): ChildMenu
    {
        $this->state = $state;

        return $this;
    }
}

class Permissions
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $menuName;

    /**
     * @var string
     */
    private $isEnabled;

    /**
     * @var int
     */
    private $state;

    /**
     * @var array
     */
    private $childMenu;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return Permissions
     */
    public function setId(?int $id): Permissions
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMenuName(): ?string
    {
        return $this->menuName;
    }

    /**
     * @param string|null $menuName
     *
     * @return Permissions
     */
    public function setMenuName(?string $menuName): Permissions
    {
        $this->menuName = $menuName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsEnabled(): ?string
    {
        return $this->isEnabled;
    }

    /**
     * @param string|null $isEnabled
     *
     * @return Permissions
     */
    public function setIsEnabled(?string $isEnabled): Permissions
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getState(): ?int
    {
        return $this->state;
    }

    /**
     * @param int|null $state
     *
     * @return Permissions
     */
    public function setState(?int $state): Permissions
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getChildMenu(): ?array
    {
        return $this->childMenu;
    }

    /**
     * @param array|null $childMenu
     *
     * @return Permissions
     */
    public function setChildMenu(?array $childMenu): Permissions
    {
        $this->childMenu = $childMenu;

        return $this;
    }
}

class KtpCard
{
    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $updatedBy;

    /**
     * @var string
     */
    private $dateExpired;

    /**
     * @var string
     */
    private $nIK;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $maritalStatus;

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return KtpCard
     */
    public function setDateCreated(?string $dateCreated): KtpCard
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return KtpCard
     */
    public function setDateUpdated(?string $dateUpdated): KtpCard
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return KtpCard
     */
    public function setStatus(?string $status): KtpCard
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     *
     * @return KtpCard
     */
    public function setCreatedBy(?string $createdBy): KtpCard
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     *
     * @return KtpCard
     */
    public function setUpdatedBy(?string $updatedBy): KtpCard
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateExpired(): ?string
    {
        return $this->dateExpired;
    }

    /**
     * @param string|null $dateExpired
     *
     * @return KtpCard
     */
    public function setDateExpired(?string $dateExpired): KtpCard
    {
        $this->dateExpired = $dateExpired;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNIK(): ?string
    {
        return $this->nIK;
    }

    /**
     * @param string|null $nIK
     *
     * @return KtpCard
     */
    public function setNIK(?string $nIK): KtpCard
    {
        $this->nIK = $nIK;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     *
     * @return KtpCard
     */
    public function setGender(?string $gender): KtpCard
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    /**
     * @param string|null $maritalStatus
     *
     * @return KtpCard
     */
    public function setMaritalStatus(?string $maritalStatus): KtpCard
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }
}

class Addresses
{
    /**
     * @var string
     */
    private $documentKey;

    /**
     * @var string
     */
    private $documentHandle;

    /**
     * @var int
     */
    private $documentRevision;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $address1;

    /**
     * @var string
     */
    private $address2;

    /**
     * @var string
     */
    private $rt;

    /**
     * @var string
     */
    private $rw;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $village;

    /**
     * @var string
     */
    private $district;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @return string|null
     */
    public function getDocumentKey(): ?string
    {
        return $this->documentKey;
    }

    /**
     * @param string|null $documentKey
     *
     * @return Addresses
     */
    public function setDocumentKey(?string $documentKey): Addresses
    {
        $this->documentKey = $documentKey;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDocumentHandle(): ?string
    {
        return $this->documentHandle;
    }

    /**
     * @param string|null $documentHandle
     *
     * @return Addresses
     */
    public function setDocumentHandle(?string $documentHandle): Addresses
    {
        $this->documentHandle = $documentHandle;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDocumentRevision(): ?int
    {
        return $this->documentRevision;
    }

    /**
     * @param int|null $documentRevision
     *
     * @return Addresses
     */
    public function setDocumentRevision(?int $documentRevision): Addresses
    {
        $this->documentRevision = $documentRevision;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Addresses
     */
    public function setStatus(?string $status): Addresses
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    /**
     * @param string|null $address1
     *
     * @return Addresses
     */
    public function setAddress1(?string $address1): Addresses
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * @param string|null $address2
     *
     * @return Addresses
     */
    public function setAddress2(?string $address2): Addresses
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRt(): ?string
    {
        return $this->rt;
    }

    /**
     * @param string|null $rt
     *
     * @return Addresses
     */
    public function setRt(?string $rt): Addresses
    {
        $this->rt = $rt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRw(): ?string
    {
        return $this->rw;
    }

    /**
     * @param string|null $rw
     *
     * @return Addresses
     */
    public function setRw(?string $rw): Addresses
    {
        $this->rw = $rw;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     *
     * @return Addresses
     */
    public function setCity(?string $city): Addresses
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string|null $province
     *
     * @return Addresses
     */
    public function setProvince(?string $province): Addresses
    {
        $this->province = $province;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     *
     * @return Addresses
     */
    public function setPostalCode(?string $postalCode): Addresses
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return Addresses
     */
    public function setType(?string $type): Addresses
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVillage(): ?string
    {
        return $this->village;
    }

    /**
     * @param string|null $village
     *
     * @return Addresses
     */
    public function setVillage(?string $village): Addresses
    {
        $this->village = $village;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @param string|null $district
     *
     * @return Addresses
     */
    public function setDistrict(?string $district): Addresses
    {
        $this->district = $district;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     *
     * @return Addresses
     */
    public function setLatitude(?float $latitude): Addresses
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     *
     * @return Addresses
     */
    public function setLongitude(?float $longitude): Addresses
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Addresses
     */
    public function setDateCreated(?string $dateCreated): Addresses
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Addresses
     */
    public function setDateUpdated(?string $dateUpdated): Addresses
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}

class Telephones
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $ext;

    /**
     * @var string
     */
    private $telephoneType;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     *
     * @return Telephones
     */
    public function setId(?string $id): Telephones
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     *
     * @return Telephones
     */
    public function setNumber(?string $number): Telephones
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExt(): ?string
    {
        return $this->ext;
    }

    /**
     * @param string|null $ext
     *
     * @return Telephones
     */
    public function setExt(?string $ext): Telephones
    {
        $this->ext = $ext;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephoneType(): ?string
    {
        return $this->telephoneType;
    }

    /**
     * @param string|null $telephoneType
     *
     * @return Telephones
     */
    public function setTelephoneType(?string $telephoneType): Telephones
    {
        $this->telephoneType = $telephoneType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Telephones
     */
    public function setStatus(?string $status): Telephones
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Telephones
     */
    public function setDateCreated(?string $dateCreated): Telephones
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Telephones
     */
    public function setDateUpdated(?string $dateUpdated): Telephones
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}

class Emails
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     *
     * @return Emails
     */
    public function setId(?string $id): Emails
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     *
     * @return Emails
     */
    public function setAddress(?string $address): Emails
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Emails
     */
    public function setStatus(?string $status): Emails
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Emails
     */
    public function setDateCreated(?string $dateCreated): Emails
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Emails
     */
    public function setDateUpdated(?string $dateUpdated): Emails
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}

class Organization
{
    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $updatedBy;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $organizationId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Organization
     */
    public function setDateCreated(?string $dateCreated): Organization
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Organization
     */
    public function setDateUpdated(?string $dateUpdated): Organization
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Organization
     */
    public function setStatus(?string $status): Organization
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     *
     * @return Organization
     */
    public function setCreatedBy(?string $createdBy): Organization
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     *
     * @return Organization
     */
    public function setUpdatedBy(?string $updatedBy): Organization
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return Organization
     */
    public function setName(?string $name): Organization
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrganizationId(): ?string
    {
        return $this->organizationId;
    }

    /**
     * @param string|null $organizationId
     *
     * @return Organization
     */
    public function setOrganizationId(?string $organizationId): Organization
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return Organization
     */
    public function setEmail(?string $email): Organization
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     *
     * @return Organization
     */
    public function setPhoneNumber(?string $phoneNumber): Organization
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}

class Devices
{
    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $updatedBy;

    /**
     * @var string
     */
    private $pushNotificationId;

    /**
     * @var string
     */
    private $deviceId;

    /**
     * @var string
     */
    private $osName;

    /**
     * @var string
     */
    private $appVersion;

    /**
     * @var string
     */
    private $osVersion;

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Devices
     */
    public function setDateCreated(?string $dateCreated): Devices
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Devices
     */
    public function setDateUpdated(?string $dateUpdated): Devices
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Devices
     */
    public function setStatus(?string $status): Devices
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     *
     * @return Devices
     */
    public function setCreatedBy(?string $createdBy): Devices
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     *
     * @return Devices
     */
    public function setUpdatedBy(?string $updatedBy): Devices
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPushNotificationId(): ?string
    {
        return $this->pushNotificationId;
    }

    /**
     * @param string|null $pushNotificationId
     *
     * @return Devices
     */
    public function setPushNotificationId(?string $pushNotificationId): Devices
    {
        $this->pushNotificationId = $pushNotificationId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * @param string|null $deviceId
     *
     * @return Devices
     */
    public function setDeviceId(?string $deviceId): Devices
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOsName(): ?string
    {
        return $this->osName;
    }

    /**
     * @param string|null $osName
     *
     * @return Devices
     */
    public function setOsName(?string $osName): Devices
    {
        $this->osName = $osName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAppVersion(): ?string
    {
        return $this->appVersion;
    }

    /**
     * @param string|null $appVersion
     *
     * @return Devices
     */
    public function setAppVersion(?string $appVersion): Devices
    {
        $this->appVersion = $appVersion;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOsVersion(): ?string
    {
        return $this->osVersion;
    }

    /**
     * @param string|null $osVersion
     *
     * @return Devices
     */
    public function setOsVersion(?string $osVersion): Devices
    {
        $this->osVersion = $osVersion;

        return $this;
    }
}

class Badges
{
    /**
     * @var int
     */
    private $badgeId;

    /**
     * @var int
     */
    private $merchantId;

    /**
     * @var bool
     */
    private $isUnlock;

    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @return int|null
     */
    public function getBadgeId(): ?int
    {
        return $this->badgeId;
    }

    /**
     * @param int|null $badgeId
     *
     * @return Badges
     */
    public function setBadgeId(?int $badgeId): Badges
    {
        $this->badgeId = $badgeId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMerchantId(): ?int
    {
        return $this->merchantId;
    }

    /**
     * @param int|null $merchantId
     *
     * @return Badges
     */
    public function setMerchantId(?int $merchantId): Badges
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isIsUnlock(): ?bool
    {
        return $this->isUnlock;
    }

    /**
     * @param bool|null $isUnlock
     *
     * @return Badges
     */
    public function setIsUnlock(?bool $isUnlock): Badges
    {
        $this->isUnlock = $isUnlock;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Badges
     */
    public function setDateCreated(?string $dateCreated): Badges
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Badges
     */
    public function setDateUpdated(?string $dateUpdated): Badges
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}

class Config
{
    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $updatedBy;

    /**
     * @var float
     */
    private $tiering;

    /**
     * @var string
     */
    private $defaultLanguage;

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Config
     */
    public function setDateCreated(?string $dateCreated): Config
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Config
     */
    public function setDateUpdated(?string $dateUpdated): Config
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Config
     */
    public function setStatus(?string $status): Config
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     *
     * @return Config
     */
    public function setCreatedBy(?string $createdBy): Config
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     *
     * @return Config
     */
    public function setUpdatedBy(?string $updatedBy): Config
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTiering(): ?float
    {
        return $this->tiering;
    }

    /**
     * @param float|null $tiering
     *
     * @return Config
     */
    public function setTiering(?float $tiering): Config
    {
        $this->tiering = $tiering;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDefaultLanguage(): ?string
    {
        return $this->defaultLanguage;
    }

    /**
     * @param string|null $defaultLanguage
     *
     * @return Config
     */
    public function setDefaultLanguage(?string $defaultLanguage): Config
    {
        $this->defaultLanguage = $defaultLanguage;

        return $this;
    }
}

class Profile
{
    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $dateUpdated;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $updatedBy;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $nickName;

    /**
     * @var string
     */
    private $deviceId;

    /**
     * @var bool
     */
    private $lockStatus;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $level;

    /**
     * @var string
     */
    private $state;

    /**
     * @var KtpCard
     */
    private $ktpCard;

    /**
     * @var string
     */
    private $lmpCard;

    /**
     * @var string
     */
    private $passport;

    /**
     * @var string
     */
    private $document;

    /**
     * @var string
     */
    private $refNo;

    /**
     * @var int
     */
    private $userLevel;

    /**
     * @var string
     */
    private $ovoId;

    /**
     * @var string
     */
    private $dateOfBirth;

    /**
     * @var array
     */
    private $addresses;

    /**
     * @var array
     */
    private $telephones;

    /**
     * @var array
     */
    private $emails;

    /**
     * @var array
     */
    private $cards;

    /**
     * @var array
     */
    private $macAddresses;

    /**
     * @var array
     */
    private $drivers;

    /**
     * @var array
     */
    private $ovoCard;

    /**
     * @var Organization
     */
    private $organization;

    /**
     * @var string
     */
    private $bonus;

    /**
     * @var string
     */
    private $mobilePhoneNumber;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $registrationOrigin;

    /**
     * @var string
     */
    private $dateOnUpgrade;

    /**
     * @var string
     */
    private $birthPlace;

    /**
     * @var int
     */
    private $religion;

    /**
     * @var int
     */
    private $nationality;

    /**
     * @var string
     */
    private $npwpCard;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $family;

    /**
     * @var int
     */
    private $occupation;

    /**
     * @var string
     */
    private $motherMaidenName;

    /**
     * @var int
     */
    private $correspondenceType;

    /**
     * @var string
     */
    private $cif;

    /**
     * @var string
     */
    private $firstSignIn;

    /**
     * @var string
     */
    private $lastSignIn;

    /**
     * @var string
     */
    private $camId;

    /**
     * @var array
     */
    private $devices;

    /**
     * @var array
     */
    private $boltDevices;

    /**
     * @var string
     */
    private $isVerify;

    /**
     * @var string
     */
    private $verifyDate;

    /**
     * @var array
     */
    private $linkedMerchants;

    /**
     * @var string
     */
    private $investment;

    /**
     * @var string
     */
    private $camInvestment;

    /**
     * @var string
     */
    private $bankAccount;

    /**
     * @var string
     */
    private $savingAccount;

    /**
     * @var array
     */
    private $badges;

    /**
     * @var string
     */
    private $kycweb;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $maritalStatus;

    /**
     * @var bool
     */
    private $isEmailVerified;

    /**
     * @var bool
     */
    private $isPhoneVerified;

    /**
     * @var bool
     */
    private $isSecurityCodeSet;

    /**
     * @var string
     */
    private $loyaltyId;

    /**
     * @var string
     */
    private $eMoneyId;

    /**
     * @var string
     */
    private $eMoneyOvoId;

    /**
     * @var Config
     */
    private $config;

    /**
     * @return string|null
     */
    public function getDateCreated(): ?string
    {
        return $this->dateCreated;
    }

    /**
     * @param string|null $dateCreated
     *
     * @return Profile
     */
    public function setDateCreated(?string $dateCreated): Profile
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->dateUpdated;
    }

    /**
     * @param string|null $dateUpdated
     *
     * @return Profile
     */
    public function setDateUpdated(?string $dateUpdated): Profile
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Profile
     */
    public function setStatus(?string $status): Profile
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string|null $createdBy
     *
     * @return Profile
     */
    public function setCreatedBy(?string $createdBy): Profile
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     *
     * @return Profile
     */
    public function setUpdatedBy(?string $updatedBy): Profile
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @param string|null $fullName
     *
     * @return Profile
     */
    public function setFullName(?string $fullName): Profile
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNickName(): ?string
    {
        return $this->nickName;
    }

    /**
     * @param string|null $nickName
     *
     * @return Profile
     */
    public function setNickName(?string $nickName): Profile
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    /**
     * @param string|null $deviceId
     *
     * @return Profile
     */
    public function setDeviceId(?string $deviceId): Profile
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isLockStatus(): ?bool
    {
        return $this->lockStatus;
    }

    /**
     * @param bool|null $lockStatus
     *
     * @return Profile
     */
    public function setLockStatus(?bool $lockStatus): Profile
    {
        $this->lockStatus = $lockStatus;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return Profile
     */
    public function setType(?string $type): Profile
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * @param string|null $level
     *
     * @return Profile
     */
    public function setLevel(?string $level): Profile
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     *
     * @return Profile
     */
    public function setState(?string $state): Profile
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return KtpCard|null
     */
    public function getKtpCard(): ?KtpCard
    {
        return $this->ktpCard;
    }

    /**
     * @param KtpCard|null $ktpCard
     *
     * @return Profile
     */
    public function setKtpCard(?KtpCard $ktpCard): Profile
    {
        $this->ktpCard = $ktpCard;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLmpCard(): ?string
    {
        return $this->lmpCard;
    }

    /**
     * @param string|null $lmpCard
     *
     * @return Profile
     */
    public function setLmpCard(?string $lmpCard): Profile
    {
        $this->lmpCard = $lmpCard;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassport(): ?string
    {
        return $this->passport;
    }

    /**
     * @param string|null $passport
     *
     * @return Profile
     */
    public function setPassport(?string $passport): Profile
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDocument(): ?string
    {
        return $this->document;
    }

    /**
     * @param string|null $document
     *
     * @return Profile
     */
    public function setDocument(?string $document): Profile
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRefNo(): ?string
    {
        return $this->refNo;
    }

    /**
     * @param string|null $refNo
     *
     * @return Profile
     */
    public function setRefNo(?string $refNo): Profile
    {
        $this->refNo = $refNo;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserLevel(): ?int
    {
        return $this->userLevel;
    }

    /**
     * @param int|null $userLevel
     *
     * @return Profile
     */
    public function setUserLevel(?int $userLevel): Profile
    {
        $this->userLevel = $userLevel;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOvoId(): ?string
    {
        return $this->ovoId;
    }

    /**
     * @param string|null $ovoId
     *
     * @return Profile
     */
    public function setOvoId(?string $ovoId): Profile
    {
        $this->ovoId = $ovoId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }

    /**
     * @param string|null $dateOfBirth
     *
     * @return Profile
     */
    public function setDateOfBirth(?string $dateOfBirth): Profile
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getAddresses(): ?array
    {
        return $this->addresses;
    }

    /**
     * @param array|null $addresses
     *
     * @return Profile
     */
    public function setAddresses(?array $addresses): Profile
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getTelephones(): ?array
    {
        return $this->telephones;
    }

    /**
     * @param array|null $telephones
     *
     * @return Profile
     */
    public function setTelephones(?array $telephones): Profile
    {
        $this->telephones = $telephones;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getEmails(): ?array
    {
        return $this->emails;
    }

    /**
     * @param array|null $emails
     *
     * @return Profile
     */
    public function setEmails(?array $emails): Profile
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCards(): ?array
    {
        return $this->cards;
    }

    /**
     * @param array|null $cards
     *
     * @return Profile
     */
    public function setCards(?array $cards): Profile
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getMacAddresses(): ?array
    {
        return $this->macAddresses;
    }

    /**
     * @param array|null $macAddresses
     *
     * @return Profile
     */
    public function setMacAddresses(?array $macAddresses): Profile
    {
        $this->macAddresses = $macAddresses;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getDrivers(): ?array
    {
        return $this->drivers;
    }

    /**
     * @param array|null $drivers
     *
     * @return Profile
     */
    public function setDrivers(?array $drivers): Profile
    {
        $this->drivers = $drivers;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getOvoCard(): ?array
    {
        return $this->ovoCard;
    }

    /**
     * @param array|null $ovoCard
     *
     * @return Profile
     */
    public function setOvoCard(?array $ovoCard): Profile
    {
        $this->ovoCard = $ovoCard;

        return $this;
    }

    /**
     * @return Organization|null
     */
    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    /**
     * @param Organization|null $organization
     *
     * @return Profile
     */
    public function setOrganization(?Organization $organization): Profile
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBonus(): ?string
    {
        return $this->bonus;
    }

    /**
     * @param string|null $bonus
     *
     * @return Profile
     */
    public function setBonus(?string $bonus): Profile
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMobilePhoneNumber(): ?string
    {
        return $this->mobilePhoneNumber;
    }

    /**
     * @param string|null $mobilePhoneNumber
     *
     * @return Profile
     */
    public function setMobilePhoneNumber(?string $mobilePhoneNumber): Profile
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return Profile
     */
    public function setEmail(?string $email): Profile
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegistrationOrigin(): ?string
    {
        return $this->registrationOrigin;
    }

    /**
     * @param string|null $registrationOrigin
     *
     * @return Profile
     */
    public function setRegistrationOrigin(?string $registrationOrigin): Profile
    {
        $this->registrationOrigin = $registrationOrigin;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateOnUpgrade(): ?string
    {
        return $this->dateOnUpgrade;
    }

    /**
     * @param string|null $dateOnUpgrade
     *
     * @return Profile
     */
    public function setDateOnUpgrade(?string $dateOnUpgrade): Profile
    {
        $this->dateOnUpgrade = $dateOnUpgrade;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    /**
     * @param string|null $birthPlace
     *
     * @return Profile
     */
    public function setBirthPlace(?string $birthPlace): Profile
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getReligion(): ?int
    {
        return $this->religion;
    }

    /**
     * @param int|null $religion
     *
     * @return Profile
     */
    public function setReligion(?int $religion): Profile
    {
        $this->religion = $religion;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNationality(): ?int
    {
        return $this->nationality;
    }

    /**
     * @param int|null $nationality
     *
     * @return Profile
     */
    public function setNationality(?int $nationality): Profile
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNpwpCard(): ?string
    {
        return $this->npwpCard;
    }

    /**
     * @param string|null $npwpCard
     *
     * @return Profile
     */
    public function setNpwpCard(?string $npwpCard): Profile
    {
        $this->npwpCard = $npwpCard;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string|null $company
     *
     * @return Profile
     */
    public function setCompany(?string $company): Profile
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFamily(): ?string
    {
        return $this->family;
    }

    /**
     * @param string|null $family
     *
     * @return Profile
     */
    public function setFamily(?string $family): Profile
    {
        $this->family = $family;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOccupation(): ?int
    {
        return $this->occupation;
    }

    /**
     * @param int|null $occupation
     *
     * @return Profile
     */
    public function setOccupation(?int $occupation): Profile
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMotherMaidenName(): ?string
    {
        return $this->motherMaidenName;
    }

    /**
     * @param string|null $motherMaidenName
     *
     * @return Profile
     */
    public function setMotherMaidenName(?string $motherMaidenName): Profile
    {
        $this->motherMaidenName = $motherMaidenName;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCorrespondenceType(): ?int
    {
        return $this->correspondenceType;
    }

    /**
     * @param int|null $correspondenceType
     *
     * @return Profile
     */
    public function setCorrespondenceType(?int $correspondenceType): Profile
    {
        $this->correspondenceType = $correspondenceType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCif(): ?string
    {
        return $this->cif;
    }

    /**
     * @param string|null $cif
     *
     * @return Profile
     */
    public function setCif(?string $cif): Profile
    {
        $this->cif = $cif;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstSignIn(): ?string
    {
        return $this->firstSignIn;
    }

    /**
     * @param string|null $firstSignIn
     *
     * @return Profile
     */
    public function setFirstSignIn(?string $firstSignIn): Profile
    {
        $this->firstSignIn = $firstSignIn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastSignIn(): ?string
    {
        return $this->lastSignIn;
    }

    /**
     * @param string|null $lastSignIn
     *
     * @return Profile
     */
    public function setLastSignIn(?string $lastSignIn): Profile
    {
        $this->lastSignIn = $lastSignIn;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCamId(): ?string
    {
        return $this->camId;
    }

    /**
     * @param string|null $camId
     *
     * @return Profile
     */
    public function setCamId(?string $camId): Profile
    {
        $this->camId = $camId;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getDevices(): ?array
    {
        return $this->devices;
    }

    /**
     * @param array|null $devices
     *
     * @return Profile
     */
    public function setDevices(?array $devices): Profile
    {
        $this->devices = $devices;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getBoltDevices(): ?array
    {
        return $this->boltDevices;
    }

    /**
     * @param array|null $boltDevices
     *
     * @return Profile
     */
    public function setBoltDevices(?array $boltDevices): Profile
    {
        $this->boltDevices = $boltDevices;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIsVerify(): ?string
    {
        return $this->isVerify;
    }

    /**
     * @param string|null $isVerify
     *
     * @return Profile
     */
    public function setIsVerify(?string $isVerify): Profile
    {
        $this->isVerify = $isVerify;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVerifyDate(): ?string
    {
        return $this->verifyDate;
    }

    /**
     * @param string|null $verifyDate
     *
     * @return Profile
     */
    public function setVerifyDate(?string $verifyDate): Profile
    {
        $this->verifyDate = $verifyDate;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getLinkedMerchants(): ?array
    {
        return $this->linkedMerchants;
    }

    /**
     * @param array|null $linkedMerchants
     *
     * @return Profile
     */
    public function setLinkedMerchants(?array $linkedMerchants): Profile
    {
        $this->linkedMerchants = $linkedMerchants;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInvestment(): ?string
    {
        return $this->investment;
    }

    /**
     * @param string|null $investment
     *
     * @return Profile
     */
    public function setInvestment(?string $investment): Profile
    {
        $this->investment = $investment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCamInvestment(): ?string
    {
        return $this->camInvestment;
    }

    /**
     * @param string|null $camInvestment
     *
     * @return Profile
     */
    public function setCamInvestment(?string $camInvestment): Profile
    {
        $this->camInvestment = $camInvestment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankAccount(): ?string
    {
        return $this->bankAccount;
    }

    /**
     * @param string|null $bankAccount
     *
     * @return Profile
     */
    public function setBankAccount(?string $bankAccount): Profile
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSavingAccount(): ?string
    {
        return $this->savingAccount;
    }

    /**
     * @param string|null $savingAccount
     *
     * @return Profile
     */
    public function setSavingAccount(?string $savingAccount): Profile
    {
        $this->savingAccount = $savingAccount;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getBadges(): ?array
    {
        return $this->badges;
    }

    /**
     * @param array|null $badges
     *
     * @return Profile
     */
    public function setBadges(?array $badges): Profile
    {
        $this->badges = $badges;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKycweb(): ?string
    {
        return $this->kycweb;
    }

    /**
     * @param string|null $kycweb
     *
     * @return Profile
     */
    public function setKycweb(?string $kycweb): Profile
    {
        $this->kycweb = $kycweb;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string|null $gender
     *
     * @return Profile
     */
    public function setGender(?string $gender): Profile
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    /**
     * @param string|null $maritalStatus
     *
     * @return Profile
     */
    public function setMaritalStatus(?string $maritalStatus): Profile
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isIsEmailVerified(): ?bool
    {
        return $this->isEmailVerified;
    }

    /**
     * @param bool|null $isEmailVerified
     *
     * @return Profile
     */
    public function setIsEmailVerified(?bool $isEmailVerified): Profile
    {
        $this->isEmailVerified = $isEmailVerified;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isIsPhoneVerified(): ?bool
    {
        return $this->isPhoneVerified;
    }

    /**
     * @param bool|null $isPhoneVerified
     *
     * @return Profile
     */
    public function setIsPhoneVerified(?bool $isPhoneVerified): Profile
    {
        $this->isPhoneVerified = $isPhoneVerified;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isIsSecurityCodeSet(): ?bool
    {
        return $this->isSecurityCodeSet;
    }

    /**
     * @param bool|null $isSecurityCodeSet
     *
     * @return Profile
     */
    public function setIsSecurityCodeSet(?bool $isSecurityCodeSet): Profile
    {
        $this->isSecurityCodeSet = $isSecurityCodeSet;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLoyaltyId(): ?string
    {
        return $this->loyaltyId;
    }

    /**
     * @param string|null $loyaltyId
     *
     * @return Profile
     */
    public function setLoyaltyId(?string $loyaltyId): Profile
    {
        $this->loyaltyId = $loyaltyId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEMoneyId(): ?string
    {
        return $this->eMoneyId;
    }

    /**
     * @param string|null $eMoneyId
     *
     * @return Profile
     */
    public function setEMoneyId(?string $eMoneyId): Profile
    {
        $this->eMoneyId = $eMoneyId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEMoneyOvoId(): ?string
    {
        return $this->eMoneyOvoId;
    }

    /**
     * @param string|null $eMoneyOvoId
     *
     * @return Profile
     */
    public function setEMoneyOvoId(?string $eMoneyOvoId): Profile
    {
        $this->eMoneyOvoId = $eMoneyOvoId;

        return $this;
    }

    /**
     * @return Config|null
     */
    public function getConfig(): ?Config
    {
        return $this->config;
    }

    /**
     * @param Config|null $config
     *
     * @return Profile
     */
    public function setConfig(?Config $config): Profile
    {
        $this->config = $config;

        return $this;
    }
}

class FrontResponse
{
    /**
     * @var Balance
     */
    private $balance;

    /**
     * @var array
     */
    private $permissions;

    /**
     * @var Profile
     */
    private $profile;

    public function __construct($data)
    {
        $balance = new Balance;
        $balance->set600(
            (new C600)
            ->setCardBalance($data->balance->{'600'}->card_balance)
            ->setCardNo($data->balance->{'600'}->card_no)
            ->setPaymentMethod($data->balance->{'600'}->payment_method)
        )->set000(
            (new C000)
            ->setCardBalance($data->balance->{'000'}->card_balance)
            ->setCardNo($data->balance->{'000'}->card_no)
            ->setPaymentMethod($data->balance->{'000'}->payment_method)
        )->set001(
            (new C001)
            ->setCardBalance($data->balance->{'001'}->card_balance)
            ->setCardNo($data->balance->{'001'}->card_no)
            ->setPaymentMethod($data->balance->{'001'}->payment_method)
        );

        $permission = new Permissions;
        $profile    = new Profile;
        $profile
            ->setDateCreated($data->profile->dateCreated)
            ->setDateUpdated($data->profile->dateUpdated)
            ->setStatus($data->profile->status)
            ->setCreatedBy($data->profile->createdBy)
            ->setUpdatedBy($data->profile->updatedBy)
            ->setFullName($data->profile->fullName)
            ->setDeviceId($data->profile->deviceId)
            ->setLockStatus($data->profile->lockStatus)
            ->setType($data->profile->type)
            ->setLevel($data->profile->level)
            ->setState($data->profile->state)
            ->setKtpCard(
                (new KtpCard)
                ->setNIK($data->profile->ktpCard->NIK)
                ->setGender($data->profile->ktpCard->gender)
                ->setMaritalStatus($data->profile->ktpCard->maritalStatus)
                ->setDateExpired($data->profile->ktpCard->dateExpired)
            )
            ->setLmpCard($data->profile->lmpCard)
            ->setPassport($data->profile->passport)
            ->setDocument($data->profile->document)
            ->setRefNo($data->profile->refNo)
            ->setUserLevel($data->profile->userLevel)
            ->setOvoId($data->profile->ovoId)
            ->setDateOfBirth($data->profile->dateOfBirth)
            ->setMobilePhoneNumber($data->profile->mobilePhoneNumber)
            ->setEmail($data->profile->email)
            ->setRegistrationOrigin($data->profile->registrationOrigin)
            ->setDateOnUpgrade($data->profile->dateOnUpgrade)
            ->setBirthPlace($data->profile->birthPlace)
            ->setMotherMaidenName($data->profile->motherMaidenName)
            ->setFirstSignIn($data->profile->firstSignIn)
            ->setLastSignIn($data->profile->lastSignIn)
            ->setGender($data->profile->gender)
            ->setIsSecurityCodeSet($data->profile->isSecurityCodeSet)
            ->setIsEmailVerified($data->profile->isEmailVerified)
            ->setIsPhoneVerified($data->profile->isPhoneVerified)
        ;
        $this->balance     = $balance;
        $this->permissions = $permission;
        $this->profile     = $profile;
    }

    /**
     * @return Balance|null
     */
    public function getBalance(): ?Balance
    {
        return $this->balance;
    }

    /**
     * @param Balance|null $balance
     *
     * @return FrontResponse
     */
    public function setBalance(?Balance $balance): FrontResponse
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    /**
     * @param array|null $permissions
     *
     * @return FrontResponse
     */
    public function setPermissions(?array $permissions): FrontResponse
    {
        $this->permissions = $permissions;

        return $this;
    }

    /**
     * @return Profile|null
     */
    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    /**
     * @param Profile|null $profile
     *
     * @return FrontResponse
     */
    public function setProfile(?Profile $profile): FrontResponse
    {
        $this->profile = $profile;

        return $this;
    }
}
