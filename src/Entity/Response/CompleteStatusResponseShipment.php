<?php

/**
 * The MIT License (MIT).
 *
 * Copyright (c) 2017-2023 Michael Dekker (https://github.com/firstred)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
 * associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to whom the Software
 * is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or
 * substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
 * NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author    Michael Dekker <git@michaeldekker.nl>
 * @copyright 2017-2023 Michael Dekker
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

declare(strict_types=1);

namespace Firstred\PostNL\Entity\Response;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Exception;
use Firstred\PostNL\Attribute\SerializableProperty;
use Firstred\PostNL\Entity\AbstractEntity;
use Firstred\PostNL\Entity\Address;
use Firstred\PostNL\Entity\Amount;
use Firstred\PostNL\Entity\Customer;
use Firstred\PostNL\Entity\Dimension;
use Firstred\PostNL\Entity\Expectation;
use Firstred\PostNL\Entity\Group;
use Firstred\PostNL\Entity\ProductOption;
use Firstred\PostNL\Entity\Status;
use Firstred\PostNL\Entity\StatusAddress;
use Firstred\PostNL\Entity\Warning;
use Firstred\PostNL\Exception\DeserializationException;
use Firstred\PostNL\Exception\InvalidArgumentException;
use Firstred\PostNL\Exception\InvalidConfigurationException;
use Firstred\PostNL\Exception\NotSupportedException as PostNLNotSupportedException;
use stdClass;

/**
 * @since 1.0.0
 */
class CompleteStatusResponseShipment extends AbstractEntity
{
    /** @var StatusAddress[]|null $Addresses */
    #[SerializableProperty(type: StatusAddress::class, isArray: true)]
    protected ?array $Addresses = null;

    /** @var Amount[]|null $Amounts */
    #[SerializableProperty(type: Amount::class, isArray: true, aliases: ['Amount'])]
    protected ?array $Amounts = null;

    /** @var string|null $Barcode */
    #[SerializableProperty(type: 'string')]
    protected ?string $Barcode = null;

    /** @var Customer|null $Customer */
    #[SerializableProperty(type: Customer::class)]
    protected ?Customer $Customer = null;

    /** @var DateTimeInterface|null $DeliveryDate */
    #[SerializableProperty(type: DateTimeInterface::class)]
    protected ?DateTimeInterface $DeliveryDate = null;

    /** @var Dimension|null $Dimension */
    #[SerializableProperty(type: Dimension::class)]
    protected ?Dimension $Dimension = null;

    /** @var CompleteStatusResponseEvent[]|null $Events */
    #[SerializableProperty(type: CompleteStatusResponseEvent::class, isArray: true)]
    protected ?array $Events = null;

    /** @var Expectation|null $Expectation */
    #[SerializableProperty(type: Expectation::class)]
    protected ?Expectation $Expectation = null;

    /** @var Group[]|null $Groups */
    #[SerializableProperty(type: Group::class)]
    protected ?array $Groups = null;

    /** @var string|null $MainBarcode */
    #[SerializableProperty(type: 'string')]
    protected ?string $MainBarcode = null;

    /** @var CompleteStatusResponseOldStatus[]|null $OldStatuses */
    #[SerializableProperty(type: CompleteStatusResponseOldStatus::class, isArray: true)]
    protected ?array $OldStatuses = null;

    /** @var string|null $ProductCode */
    #[SerializableProperty(type: 'string')]
    protected ?string $ProductCode = null;

    /** @var string|null $ProductDescription */
    #[SerializableProperty(type: 'string')]
    protected ?string $ProductDescription = null;

    /** @var ProductOption[]|null $ProductOptions */
    #[SerializableProperty(type: ProductOption::class, isArray: true)]
    protected ?array $ProductOptions = null;

    /** @var string|null $Reference */
    #[SerializableProperty(type: 'string')]
    protected ?string $Reference = null;

    /** @var string|null $ShipmentAmount */
    #[SerializableProperty(type: 'string')]
    protected ?string $ShipmentAmount = null;

    /** @var string|null $ShipmentCounter */
    #[SerializableProperty(type: 'string')]
    protected ?string $ShipmentCounter = null;

    /** @var Status|null $Status */
    #[SerializableProperty(type: Status::class)]
    protected ?Status $Status = null;

    /** @var Warning[]|null $Warnings */
    #[SerializableProperty(type: Warning::class, isArray: true)]
    protected ?array $Warnings = null;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct(
        /* @param StatusAddress[]|null $Addresses */
        ?array $Addresses = null,
        /* @param Amount[]|null $Amounts */
        ?array $Amounts = null,
        ?string $Barcode = null,
        ?Customer $Customer = null,
        DateTimeInterface|string|null $DeliveryDate = null,
        ?Dimension $Dimension = null,
        /* @param CompleteStatusResponseEvent[]|null $Events */
        ?array $Events = null,
        ?Expectation $Expectation = null,
        /* @param Group[]|null $Groups */
        ?array $Groups = null,
        /* @param CompleteStatusResponseOldStatus[]|null $OldStatuses */
        ?array $OldStatuses = null,
        ?string $ProductCode = null,
        /* @param ProductOption[]|null $ProductOptions */
        ?array $ProductOptions = null,
        ?string $Reference = null,
        ?Status $Status = null,
        /* @param Warning[]|null $Warnings */
        ?array $Warnings = null,
        ?string $MainBarcode = null,
        ?string $ShipmentAmount = null,
        ?string $ShipmentCounter = null,
        ?string $ProductDescription = null
    ) {
        parent::__construct();

        $this->setAddresses(Addresses: $Addresses);
        $this->setAmounts(Amounts: $Amounts);
        $this->setBarcode(Barcode: $Barcode);
        $this->setCustomer(Customer: $Customer);
        $this->setDeliveryDate(DeliveryDate: $DeliveryDate);
        $this->setDimension(Dimension: $Dimension);
        $this->setEvents(Events: $Events);
        $this->setExpectation(Expectation: $Expectation);
        $this->setGroups(Groups: $Groups);
        $this->setOldStatuses(OldStatuses: $OldStatuses);
        $this->setProductCode(ProductCode: $ProductCode);
        $this->setProductOptions(ProductOptions: $ProductOptions);
        $this->setReference(Reference: $Reference);
        $this->setStatus(Status: $Status);
        $this->setWarnings(Warnings: $Warnings);
        $this->setMainBarcode(MainBarcode: $MainBarcode);
        $this->setShipmentAmount(ShipmentAmount: $ShipmentAmount);
        $this->setShipmentCounter(ShipmentCounter: $ShipmentCounter);
        $this->setProductDescription(ProductDescription: $ProductDescription);
    }

    /**
     * @return Address[]|null
     */
    public function getAddresses(): ?array
    {
        return $this->Addresses;
    }

    /**
     * @param Amount[]|null $Addresses
     *
     * @return static
     */
    public function setAddresses(?array $Addresses): static
    {
        $this->Addresses = $Addresses;

        return $this;
    }

    /**
     * @return Amount[]|null
     */
    public function getAmounts(): ?array
    {
        return $this->Amounts;
    }

    /**
     * @param array|null $Amounts
     *
     * @return static
     */
    public function setAmounts(?array $Amounts): static
    {
        $this->Amounts = $Amounts;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->Barcode;
    }

    /**
     * @param string|null $Barcode
     *
     * @return static
     */
    public function setBarcode(?string $Barcode): static
    {
        $this->Barcode = $Barcode;

        return $this;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->Customer;
    }

    /**
     * @param Customer|null $Customer
     *
     * @return static
     */
    public function setCustomer(?Customer $Customer): static
    {
        $this->Customer = $Customer;

        return $this;
    }

    /**
     * @return Dimension|null
     */
    public function getDimension(): ?Dimension
    {
        return $this->Dimension;
    }

    /**
     * @param Dimension|null $Dimension
     *
     * @return static
     */
    public function setDimension(?Dimension $Dimension): static
    {
        $this->Dimension = $Dimension;

        return $this;
    }

    /**
     * @return CompleteStatusResponseEvent[]|null
     */
    public function getEvents(): ?array
    {
        return $this->Events;
    }

    /**
     * @param CompleteStatusResponseEvent[]|null $Events
     *
     * @return CompleteStatusResponseShipment
     */
    public function setEvents(?array $Events): static
    {
        $this->Events = $Events;

        return $this;
    }

    /**
     * @return Expectation|null
     */
    public function getExpectation(): ?Expectation
    {
        return $this->Expectation;
    }

    /**
     * @param Expectation|null $Expectation
     *
     * @return static
     */
    public function setExpectation(?Expectation $Expectation): static
    {
        $this->Expectation = $Expectation;

        return $this;
    }

    /**
     * @return Group[]|null
     */
    public function getGroups(): ?array
    {
        return $this->Groups;
    }

    /**
     * @param array|null $Groups
     *
     * @return CompleteStatusResponseShipment
     */
    public function setGroups(?array $Groups): static
    {
        $this->Groups = $Groups;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMainBarcode(): ?string
    {
        return $this->MainBarcode;
    }

    /**
     * @param string|null $MainBarcode
     *
     * @return static
     */
    public function setMainBarcode(?string $MainBarcode): static
    {
        $this->MainBarcode = $MainBarcode;

        return $this;
    }

    /**
     * @return CompleteStatusResponseOldStatus[]|null
     */
    public function getOldStatuses(): ?array
    {
        return $this->OldStatuses;
    }

    /**
     * @param CompleteStatusResponseOldStatus[]|null $OldStatuses
     *
     * @return static
     */
    public function setOldStatuses(?array $OldStatuses): static
    {
        $this->OldStatuses = $OldStatuses;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductCode(): ?string
    {
        return $this->ProductCode;
    }

    /**
     * @param string|null $ProductCode
     *
     * @return static
     */
    public function setProductCode(?string $ProductCode): static
    {
        $this->ProductCode = $ProductCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductDescription(): ?string
    {
        return $this->ProductDescription;
    }

    /**
     * @param string|null $ProductDescription
     *
     * @return static
     */
    public function setProductDescription(?string $ProductDescription): static
    {
        $this->ProductDescription = $ProductDescription;

        return $this;
    }

    /**
     * @return ProductOption[]|null
     */
    public function getProductOptions(): ?array
    {
        return $this->ProductOptions;
    }

    /**
     * @param ProductOption[]|null $ProductOptions
     *
     * @return static
     */
    public function setProductOptions(?array $ProductOptions): static
    {
        $this->ProductOptions = $ProductOptions;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->Reference;
    }

    /**
     * @param string|null $Reference
     *
     * @return static
     */
    public function setReference(?string $Reference): static
    {
        $this->Reference = $Reference;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShipmentAmount(): ?string
    {
        return $this->ShipmentAmount;
    }

    /**
     * @param string|null $ShipmentAmount
     *
     * @return static
     */
    public function setShipmentAmount(?string $ShipmentAmount): static
    {
        $this->ShipmentAmount = $ShipmentAmount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShipmentCounter(): ?string
    {
        return $this->ShipmentCounter;
    }

    /**
     * @param string|null $ShipmentCounter
     *
     * @return static
     */
    public function setShipmentCounter(?string $ShipmentCounter): static
    {
        $this->ShipmentCounter = $ShipmentCounter;

        return $this;
    }

    /**
     * @return Status|null
     */
    public function getStatus(): ?Status
    {
        return $this->Status;
    }

    /**
     * @param Status|null $Status
     *
     * @return static
     */
    public function setStatus(?Status $Status): static
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * @return Warning[]|null
     */
    public function getWarnings(): ?array
    {
        return $this->Warnings;
    }

    /**
     * @param array|null $Warnings
     *
     * @return static
     */
    public function setWarnings(?array $Warnings): static
    {
        $this->Warnings = $Warnings;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDeliveryDate(): ?DateTimeInterface
    {
        return $this->DeliveryDate;
    }

    /**
     * @throws InvalidArgumentException
     *
     * @since 1.2.0
     */
    public function setDeliveryDate(string|DateTimeInterface|null $DeliveryDate = null): static
    {
        if (is_string(value: $DeliveryDate)) {
            try {
                $DeliveryDate = new DateTimeImmutable(datetime: $DeliveryDate, timezone: new DateTimeZone(timezone: 'Europe/Amsterdam'));
            } catch (Exception $e) {
                throw new InvalidArgumentException(message: $e->getMessage(), code: 0, previous: $e);
            }
        }

        $this->DeliveryDate = $DeliveryDate;

        return $this;
    }

    /**
     * @param stdClass $json
     *
     * @return CompleteStatusResponseShipment
     *
     * @throws DeserializationException
     * @throws PostNLNotSupportedException
     * @throws InvalidConfigurationException
     *
     * @since 1.2.0
     */
    public static function jsonDeserialize(stdClass $json): static
    {
        if (isset($json->CompleteStatusResponseShipment->Address)) {
            $json->CompleteStatusResponseShipment->Addresses = $json->CompleteStatusResponseShipment->Address;
            unset($json->CompleteStatusResponseShipment->Address);

            if (!is_array(value: $json->CompleteStatusResponseShipment->Addresses)) {
                $json->CompleteStatusResponseShipment->Addresses = [$json->CompleteStatusResponseShipment->Addresses];
            }
        }

        return parent::jsonDeserialize(json: $json);
    }
}
