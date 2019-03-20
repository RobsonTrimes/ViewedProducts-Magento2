<?php


namespace Magecommerce\ViewedProducts\Model;

use Magento\Framework\App\ResourceConnection;

class ViewedProductsManagement implements \Magecommerce\ViewedProducts\Api\ViewedProductsManagementInterface
{
    private $resourceConnection;

    public function __construct(
        ResourceConnection $resourceConnection
    )
    {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * {@inheritdoc}
     */

    public function getViewedProducts($param)
    {
        try{
            if ($param == 'all'){

                $connection= $this->resourceConnection->getConnection();

                $sql = "SELECT * FROM report_viewed_product_index where customer_id is not null";
                $result = $connection->fetchAll($sql);

                if (empty($result)){
                    return false;
                }

                $result = json_encode($result);

                return $result;
             }

        }catch (\Exception $e){

            $this->logger->error($e->getMessage());
            return $e->getMessage();

        }

        return 'Invalid parameter';
    }

}
