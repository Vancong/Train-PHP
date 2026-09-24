    <?php 
        function formatMoney (int $amount) :string {
            return number_format($amount,0,',', '.');
        }
        
        echo formatMoney(7500000) . ' VND'. "\n";
    
        function getOrderStatus (int $status) :string {
            return match ($status) {
                0 => 'Đơn mới',
                1 => 'Đã xác nhận',
                2 => 'Đang đóng gói',
                3 => 'Đang giao',
                4 => 'Hoàn thành',
                5 => 'Hủy',
                default => 'Trạng thái không hợp lệ',
            };
        }

        echo getOrderStatus(3) . "\n";

        function calculateOrderTotal(array $orders) :int {
            $total=0;
            foreach($orders as $order) { 
                $total+=$order['total'];
            }
            return $total;
        } 

        $orders = [
            ['order_code'=>'DH001','customer'=>'Nguyễn Văn A','source'=>'Shopee Kuchen','total'=>7500000,'status'=>'completed'],
            ['order_code'=>'DH002','customer'=>'Trần Văn B','source'=>'Website','total'=>4500000,'status'=>'processing'],
            ['order_code'=>'DH003','customer'=>'Lê Văn C','source'=>'Shopee Kuchen','total'=>12000000,'status'=>'completed'],
        ];

        $total = calculateOrderTotal($orders);
        echo formatMoney($total) . ' VND' . "\n";

        function findByOrderByCode (array $orders, string $orderCode) : ?array {
            foreach($orders as $order) {
                if ($order['order_code'] === $orderCode) {
                    return $order;
                }   
            }
            return null;
        }

        $foundOrder= findByOrderByCode ($orders, 'DH002');
        if ($foundOrder) {
            echo "Tim thay don hang: " . $foundOrder['order_code'] . "\n";
        }
        else {
            echo "Khong tim thay don hang \n";
        }

        function filterOrdersBySource(array $orders, string $source): array {
            $filteredOrders = [];
            foreach($orders as $order) {
                    if ($order['source'] === $source) {
                        $filteredOrders[] = $order;
                }
            }
            return $filteredOrders;
        }

        $shopeeOrders = filterOrdersBySource($orders, 'Shopee Kuchen');
        foreach ($shopeeOrders as $order) {
            echo $order['order_code'] . "\n";
        }
    ?>