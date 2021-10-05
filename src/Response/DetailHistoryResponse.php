<?php
namespace Stelin\Response;

class DetailHistoryData
{
    /**
     * @var string
     */
    private $merchantInvoice;

    /**
     * @var string
     */
    private $merchantId;

    /**
     * @var string
     */
    private $merchantName;

    /**
     * @var string
     */
    private $transactionDate;

    /**
     * @var string
     */
    private $transactionTime;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $completeMessage;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @var string
     */
    private $approvalCode;

    /**
     * @var string
     */
    private $externalReference;

    /**
     * @var string
     */
    private $origin;

    /**
     * @var string
     */
    private $originText;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $cardNo;

    /**
     * @var string
     */
    private $cardType;

    /**
     * @var float
     */
    private $transactionAmount;

    /**
     * @var string
     */
    private $transactionId;

    /**
     * @var string
     */
    private $desc1;

    /**
     * @var string
     */
    private $desc2;

    /**
     * @var string
     */
    private $desc3;

    /**
     * @var string
     */
    private $status;

    /**
     * @var int
     */
    private $uiType;

    /**
     * @var string
     */
    private $transactionType;

    /**
     * @var int
     */
    private $transactionTypeId;

    /**
     * @var string
     */
    private $iconUrl;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var string
     */
    private $categoryName;

    /**
     * @var string
     */
    private $note;

    /**
     * @var string
     */
    private $prefixAmount;

    /**
     * @return string|null
     */
    public function getMerchantInvoice(): ?string
    {
        return $this->merchantInvoice;
    }

    /**
     * @param string|null $merchantInvoice
     *
     * @return DetailHistoryData
     */
    public function setMerchantInvoice(?string $merchantInvoice): DetailHistoryData
    {
        $this->merchantInvoice = $merchantInvoice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    /**
     * @param string|null $merchantId
     *
     * @return DetailHistoryData
     */
    public function setMerchantId(?string $merchantId): DetailHistoryData
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMerchantName(): ?string
    {
        return $this->merchantName;
    }

    /**
     * @param string|null $merchantName
     *
     * @return DetailHistoryData
     */
    public function setMerchantName(?string $merchantName): DetailHistoryData
    {
        $this->merchantName = $merchantName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionDate(): ?string
    {
        return $this->transactionDate;
    }

    /**
     * @param string|null $transactionDate
     *
     * @return DetailHistoryData
     */
    public function setTransactionDate(?string $transactionDate): DetailHistoryData
    {
        $this->transactionDate = $transactionDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionTime(): ?string
    {
        return $this->transactionTime;
    }

    /**
     * @param string|null $transactionTime
     *
     * @return DetailHistoryData
     */
    public function setTransactionTime(?string $transactionTime): DetailHistoryData
    {
        $this->transactionTime = $transactionTime;

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
     * @return DetailHistoryData
     */
    public function setName(?string $name): DetailHistoryData
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompleteMessage(): ?string
    {
        return $this->completeMessage;
    }

    /**
     * @param string|null $completeMessage
     *
     * @return DetailHistoryData
     */
    public function setCompleteMessage(?string $completeMessage): DetailHistoryData
    {
        $this->completeMessage = $completeMessage;

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
     * @return DetailHistoryData
     */
    public function setPaymentMethod(?string $paymentMethod): DetailHistoryData
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getApprovalCode(): ?string
    {
        return $this->approvalCode;
    }

    /**
     * @param string|null $approvalCode
     *
     * @return DetailHistoryData
     */
    public function setApprovalCode(?string $approvalCode): DetailHistoryData
    {
        $this->approvalCode = $approvalCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalReference(): ?string
    {
        return $this->externalReference;
    }

    /**
     * @param string|null $externalReference
     *
     * @return DetailHistoryData
     */
    public function setExternalReference(?string $externalReference): DetailHistoryData
    {
        $this->externalReference = $externalReference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    /**
     * @param string|null $origin
     *
     * @return DetailHistoryData
     */
    public function setOrigin(?string $origin): DetailHistoryData
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOriginText(): ?string
    {
        return $this->originText;
    }

    /**
     * @param string|null $originText
     *
     * @return DetailHistoryData
     */
    public function setOriginText(?string $originText): DetailHistoryData
    {
        $this->originText = $originText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     *
     * @return DetailHistoryData
     */
    public function setPhone(?string $phone): DetailHistoryData
    {
        $this->phone = $phone;

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
     * @return DetailHistoryData
     */
    public function setCardNo(?string $cardNo): DetailHistoryData
    {
        $this->cardNo = $cardNo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCardType(): ?string
    {
        return $this->cardType;
    }

    /**
     * @param string|null $cardType
     *
     * @return DetailHistoryData
     */
    public function setCardType(?string $cardType): DetailHistoryData
    {
        $this->cardType = $cardType;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTransactionAmount(): ?float
    {
        return $this->transactionAmount;
    }

    /**
     * @param float|null $transactionAmount
     *
     * @return DetailHistoryData
     */
    public function setTransactionAmount(?float $transactionAmount): DetailHistoryData
    {
        $this->transactionAmount = $transactionAmount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    /**
     * @param string|null $transactionId
     *
     * @return DetailHistoryData
     */
    public function setTransactionId(?string $transactionId): DetailHistoryData
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDesc1(): ?string
    {
        return $this->desc1;
    }

    /**
     * @param string|null $desc1
     *
     * @return DetailHistoryData
     */
    public function setDesc1(?string $desc1): DetailHistoryData
    {
        $this->desc1 = $desc1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDesc2(): ?string
    {
        return $this->desc2;
    }

    /**
     * @param string|null $desc2
     *
     * @return DetailHistoryData
     */
    public function setDesc2(?string $desc2): DetailHistoryData
    {
        $this->desc2 = $desc2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDesc3(): ?string
    {
        return $this->desc3;
    }

    /**
     * @param string|null $desc3
     *
     * @return DetailHistoryData
     */
    public function setDesc3(?string $desc3): DetailHistoryData
    {
        $this->desc3 = $desc3;

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
     * @return DetailHistoryData
     */
    public function setStatus(?string $status): DetailHistoryData
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUiType(): ?int
    {
        return $this->uiType;
    }

    /**
     * @param int|null $uiType
     *
     * @return DetailHistoryData
     */
    public function setUiType(?int $uiType): DetailHistoryData
    {
        $this->uiType = $uiType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionType(): ?string
    {
        return $this->transactionType;
    }

    /**
     * @param string|null $transactionType
     *
     * @return DetailHistoryData
     */
    public function setTransactionType(?string $transactionType): DetailHistoryData
    {
        $this->transactionType = $transactionType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTransactionTypeId(): ?int
    {
        return $this->transactionTypeId;
    }

    /**
     * @param int|null $transactionTypeId
     *
     * @return DetailHistoryData
     */
    public function setTransactionTypeId(?int $transactionTypeId): DetailHistoryData
    {
        $this->transactionTypeId = $transactionTypeId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    /**
     * @param string|null $iconUrl
     *
     * @return DetailHistoryData
     */
    public function setIconUrl(?string $iconUrl): DetailHistoryData
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    /**
     * @param int|null $categoryId
     *
     * @return DetailHistoryData
     */
    public function setCategoryId(?int $categoryId): DetailHistoryData
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    /**
     * @param string|null $categoryName
     *
     * @return DetailHistoryData
     */
    public function setCategoryName(?string $categoryName): DetailHistoryData
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string|null $note
     *
     * @return DetailHistoryData
     */
    public function setNote(?string $note): DetailHistoryData
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrefixAmount(): ?string
    {
        return $this->prefixAmount;
    }

    /**
     * @param string|null $prefixAmount
     *
     * @return DetailHistoryData
     */
    public function setPrefixAmount(?string $prefixAmount): DetailHistoryData
    {
        $this->prefixAmount = $prefixAmount;

        return $this;
    }
}

class DetailHistoryResponse
{
    /**
     * @var int
     */
    private $status;

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $message;

    public function __construct($data)
    {
        $this->status     = $data->status;
        // $this->data       = $data->data;
        $this->message    = $data->message;
        if ($data->data == null) {
            $this->data = null;
        } else {
            $d                      = new DetailHistoryData;
            $data                   = $data->data[0];
            $d->setCardNo($data->card_no)
                ->setCardType($data->card_type)
                ->setCategoryId($data->category_id)
                ->setCategoryName($data->category_name)
                ->setCompleteMessage($data->complete_message)
                ->setDesc1($data->desc1)
                ->setDesc2($data->desc2)
                ->setDesc3($data->desc3)
                ->setExternalReference($data->externalReference)
                ->setIconUrl($data->icon_url)
                ->setMerchantId($data->merchant_id)
                ->setMerchantInvoice($data->merchant_invoice)
                ->setMerchantName($data->merchant_name)
                ->setName($data->name)
                ->setNote($data->note)
                ->setOrigin($data->origin)
                ->setOriginText($data->originText)
                ->setPaymentMethod($data->payment_method)
                ->setPhone($data->phone)
                ->setPrefixAmount($data->prefix_amount)
                ->setStatus($data->status)
                ->setTransactionAmount($data->transaction_amount)
                ->setTransactionDate($data->transaction_date)
                ->setTransactionId($data->transaction_id)
                ->setTransactionTime($data->transaction_time)
                ->setTransactionType($data->transaction_type)
                ->setTransactionTypeId($data->transaction_type_id)
                ->setUiType($data->ui_type);

            $this->data =  $d;
        }
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     *
     * @return DetailHistory
     */
    public function setStatus(?int $status): DetailHistory
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param array|null $data
     *
     * @return DetailHistory
     */
    public function setData(?array $data): DetailHistory
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     *
     * @return DetailHistory
     */
    public function setMessage(?string $message): DetailHistory
    {
        $this->message = $message;

        return $this;
    }
}
