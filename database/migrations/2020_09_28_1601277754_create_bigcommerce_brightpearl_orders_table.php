<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigcommerceBrightpearlOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('bigcommerce_brightpearl_orders', function (Blueprint $table) {

		$table->bigIncrements('id');
		$table->string('orderId',100)->nullable()->default(null);
		$table->string('customer_id',30)->nullable()->default(null);
		$table->string('customer_unique_id',30)->nullable()->default(null);
		$table->datetime('date_created')->nullable()->default(null);
		$table->datetime('date_modified')->nullable()->default(null);
		$table->string('date_shipped',30)->nullable()->default(null);
		$table->integer('status_id')->nullable()->default(null);
		$table->string('status',300)->nullable()->default(null);
		$table->decimal('subtotal_ex_tax',10,2)->nullable()->default(null);
		$table->decimal('subtotal_inc_tax',10,2)->nullable()->default(null);
		$table->decimal('subtotal_tax',10,2)->nullable()->default(null);
		$table->decimal('base_shipping_cost',10,2)->nullable()->default(null);
		$table->decimal('shipping_cost_ex_tax',10,2)->nullable()->default(null);
		$table->decimal('shipping_cost_inc_tax',10,2)->nullable()->default(null);
		$table->decimal('shipping_cost_tax',10,2)->nullable()->default(null);
		$table->integer('shipping_cost_tax_class_id')->nullable()->default(null);
		$table->decimal('base_handling_cost',10,2)->nullable()->default(null);
		$table->decimal('handling_cost_ex_tax',10,2)->nullable()->default(null);
		$table->decimal('handling_cost_inc_tax',10,2)->nullable()->default(null);
		$table->decimal('handling_cost_tax',10,2)->nullable()->default(null);
		$table->integer('handling_cost_tax_class_id')->nullable()->default(null);
		$table->decimal('base_wrapping_cost',10,2)->nullable()->default(null);
		$table->decimal('wrapping_cost_ex_tax',10,2)->nullable()->default(null);
		$table->decimal('wrapping_cost_inc_tax',10,2)->nullable()->default(null);
		$table->decimal('wrapping_cost_tax',10,2)->nullable()->default(null);
		$table->integer('wrapping_cost_tax_class_id')->nullable()->default(null);
		$table->decimal('total_ex_tax',10,2)->nullable()->default(null);
		$table->decimal('total_inc_tax',10,2)->nullable()->default(null);
		$table->decimal('total_tax',10,2)->nullable()->default(null);
		$table->integer('items_total')->nullable()->default(null);
		$table->integer('items_shipped')->nullable()->default(null);
		$table->string('payment_method',200)->nullable()->default(null);
		$table->string('payment_provider_id',100)->nullable()->default(null);
		$table->string('payment_status',200)->nullable()->default(null);
		$table->decimal('refunded_amount',10,2)->nullable()->default(null);
		$table->tinyInteger('order_is_digital')->nullable()->default(null);
		$table->decimal('store_credit_amount',10,2)->nullable()->default(null);
		$table->decimal('gift_certificate_amount',10,2)->nullable()->default(null);
		$table->string('ip_address',100)->nullable()->default(null);
		$table->string('geoip_country',200)->nullable()->default(null);
		$table->string('geoip_country_iso2',20)->nullable()->default(null);
		$table->integer('currency_id')->nullable()->default(null);
		$table->string('currency_code',20)->nullable()->default(null);
		$table->decimal('currency_exchange_rate',10,2)->nullable()->default(null);
		$table->integer('default_currency_id')->nullable()->default(null);
		$table->string('default_currency_code',100)->nullable()->default(null);
		$table->text('staff_notes')->nullable()->default(null);
		$table->text('customer_message')->nullable()->default(null);
		$table->decimal('discount_amount',10,2)->nullable()->default(null);
		$table->decimal('coupon_discount',10,2)->nullable()->default(null);
		$table->integer('shipping_address_count')->nullable()->default(null);
		$table->tinyInteger('is_deleted')->nullable()->default(null);
		$table->string('ebay_order_id',30)->nullable()->default(null);
		$table->string('cart_id',100)->nullable()->default(null);
		$table->tinyInteger('is_email_opt_in')->nullable()->default(null);
		$table->string('credit_card_type',100)->nullable()->default(null);
		$table->string('order_source',100)->nullable()->default(null);
		$table->integer('channel_id')->nullable()->default(null);
		$table->string('external_source',100)->nullable()->default(null);
		$table->string('external_id',100)->nullable()->default(null);
		$table->string('external_merchant_id',100)->nullable()->default(null);
		$table->string('tax_provider_id',100)->nullable()->default(null);
		$table->string('store_default_currency_code',100)->nullable()->default(null);
		$table->decimal('store_default_to_transactional_exchange_rate',10,2)->nullable()->default(null);
		$table->string('custom_status',300)->nullable()->default(null);
		$table->bigInteger('organization_id')->nullable()->default(null);
		$table->string('source_platform',200)->nullable()->default(null);
		$table->timestamp('created_at')->nullable()->useCurrent();
		$table->timestamp('updated_at')->nullable()->useCurrent();
		$table->string('sync_status',20)->nullable()->default(null);
		$table->bigInteger('sync_order_id')->nullable()->default(null);
		$table->bigInteger('bp_order_id')->nullable()->default(null);
		$table->integer('bp_parentOrderId')->nullable()->default(null);
		$table->string('bp_orderTypeCode',10)->nullable()->default(null);
		$table->string('bp_reference',100)->nullable()->default(null);
		$table->integer('bp_orderStatusId')->nullable()->default(null);
		$table->string('bp_orderPaymentStatus',20)->nullable()->default(null);
		$table->string('bp_stockStatusCode',20)->nullable()->default(null);
		$table->string('bp_allocationStatusCode',20)->nullable()->default(null);
		$table->string('bp_shippingStatusCode',20)->nullable()->default(null);
		$table->datetime('bp_placedOn')->nullable()->default(null);
		$table->datetime('bp_createdOn')->nullable()->default(null);
		$table->datetime('bp_updatedOn')->nullable()->default(null);
		$table->string('bp_updatedOnDate',100)->nullable()->default(null);
		$table->integer('bp_createdById')->nullable()->default(null);
		$table->integer('bp_priceListId')->nullable()->default(null);
		$table->string('bp_priceModeCode',20)->nullable()->default(null);
		$table->datetime('bp_delivery_deliveryDate')->nullable()->default(null);
		$table->integer('bp_delivery_shippingMethodId')->nullable()->default(null);
		$table->string('bp_currency_accountingCurrencyCode',20)->nullable()->default(null);
		$table->string('bp_currency_orderCurrencyCode',20)->nullable()->default(null);
		$table->decimal('bp_currency_exchangeRate',10,2)->nullable()->default(null);
		$table->tinyInteger('bp_currency_fixedExchangeRate')->nullable()->default(null);
		$table->decimal('bp_totalValue_net',10,2)->nullable()->default(null);
		$table->decimal('bp_totalValue_taxAmount',10,2)->nullable()->default(null);
		$table->decimal('bp_totalValue_baseNet',10,2)->nullable()->default(null);
		$table->decimal('bp_totalValue_baseTaxAmount',10,2)->nullable()->default(null);
		$table->decimal('bp_totalValue_baseTotal',10,2)->nullable()->default(null);
		$table->decimal('bp_totalValue_total',10,2)->nullable()->default(null);
		$table->integer('bp_assignment_staffOwnerContactId')->nullable()->default(null);
		$table->integer('bp_assignment_projectId')->nullable()->default(null);
		$table->integer('bp_assignment_channelId')->nullable()->default(null);
		$table->integer('bp_assignment_leadSourceId')->nullable()->default(null);
		$table->integer('bp_assignment_teamId')->nullable()->default(null);
		$table->integer('bp_customer_contactId')->nullable()->default(null);
		$table->string('bp_customer_addressFullName',300)->nullable()->default(null);
		$table->string('bp_customer_companyName',300)->nullable()->default(null);
		$table->string('bp_customer_addressLine1',300)->nullable()->default(null);
		$table->string('bp_customer_addressLine2',300)->nullable()->default(null);
		$table->string('bp_customer_addressLine3',300)->nullable()->default(null);
		$table->string('bp_customer_addressLine4',300)->nullable()->default(null);
		$table->string('bp_customer_postalCode',15)->nullable()->default(null);
		$table->string('bp_customer_country',15)->nullable()->default(null);
		$table->string('bp_customer_countryIsoCode',15)->nullable()->default(null);
		$table->string('bp_customer_countryIsoCode3',15)->nullable()->default(null);
		$table->string('bp_customer_telephone',15)->nullable()->default(null);
		$table->string('bp_customer_mobileTelephone',15)->nullable()->default(null);
		$table->string('bp_customer_email',200)->nullable()->default(null);
		$table->integer('bp_billing_contactId')->nullable()->default(null);
		$table->string('bp_billing_addressFullName',300)->nullable()->default(null);
		$table->string('bp_billing_companyName',300)->nullable()->default(null);
		$table->string('bp_billing_addressLine1',300)->nullable()->default(null);
		$table->string('bp_billing_addressLine2',300)->nullable()->default(null);
		$table->string('bp_billing_addressLine3',300)->nullable()->default(null);
		$table->string('bp_billing_addressLine4',300)->nullable()->default(null);
		$table->string('bp_billing_postalCode',15)->nullable()->default(null);
		$table->string('bp_billing_country',15)->nullable()->default(null);
		$table->string('bp_billing_countryIsoCode',15)->nullable()->default(null);
		$table->string('bp_billing_countryIsoCode3',15)->nullable()->default(null);
		$table->string('bp_billing_telephone',15)->nullable()->default(null);
		$table->string('bp_billing_mobileTelephone',15)->nullable()->default(null);
		$table->string('bp_billing_email',200)->nullable()->default(null);
		$table->string('bp_delivery_addressFullName',300)->nullable()->default(null);
		$table->string('bp_delivery_companyName',300)->nullable()->default(null);
		$table->string('bp_delivery_addressLine1',300)->nullable()->default(null);
		$table->string('bp_delivery_addressLine2',300)->nullable()->default(null);
		$table->string('bp_delivery_addressLine3',300)->nullable()->default(null);
		$table->string('bp_delivery_addressLine4',300)->nullable()->default(null);
		$table->string('bp_delivery_postalCode',15)->nullable()->default(null);
		$table->string('bp_delivery_country',15)->nullable()->default(null);
		$table->string('bp_delivery_countryIsoCode',15)->nullable()->default(null);
		$table->string('bp_delivery_countryIsoCode3',15)->nullable()->default(null);
		$table->string('bp_delivery_telephone',15)->nullable()->default(null);
		$table->string('bp_delivery_mobileTelephone',15)->nullable()->default(null);
		$table->string('bp_delivery_email',200)->nullable()->default(null);
		$table->integer('bp_warehouseId')->nullable()->default(null);
		$table->integer('bp_acknowledged')->nullable()->default(null);
		$table->integer('bp_costPriceListId')->nullable()->default(null);
		$table->tinyInteger('bp_isDropship')->nullable()->default(null);
		$table->integer('invoiced_status')->default('0');
		$table->integer('item_status')->default('0');
		$table->string('date_modified_backup',100)->nullable()->default(null);
		$table->text('error')->nullable()->default(null);
		$table->text('big_error')->nullable()->default(null);
		$table->string('shipment_id',30)->nullable()->default(null);
		$table->string('tracking_info',100)->nullable()->default(null);
		$table->text('shipping_error')->nullable()->default(null);
		$table->string('bp_goodsoutnoteId',30)->nullable()->default(null);
		$table->string('bp_goodnoteId',10)->nullable()->default(null);
		$table->string('shipping_status',20)->nullable()->default(null);
		$table->string('shipping_platform',100)->nullable()->default(null);
		$table->string('shipment_sync_date',30)->nullable()->default(null);
		$table->tinyInteger('customer_email_status')->default('0');
		$table->tinyInteger('item_email_status')->default('0');
		$table->tinyInteger('shipment_email_status')->default('0');

        });
    }

    public function down()
    {
        Schema::dropIfExists('bigcommerce_brightpearl_orders');
    }
}