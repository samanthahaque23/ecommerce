<h1 class="text-center text-success">
    Order Payment
</h1>
<table class="table table-bordered">
    <thead>
        <?php
        $get_orders = "select * from `user_payments`";
        $result = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($result);
        echo " <tr>
                <th>Sl No</th>
                <th>Invoice Number</th>
                <th>Amount</th>
                <th>Payment Mode</th>
                <th>Order Date</th>
                <th>Delete</th>
                </tr>
                </thead>
                <tbody>";


                if($row_count == 0){
                    echo "    <h2 class='text-danger text-center text-capitalize'>no payments yet</h2>
                    ";
                }else{
                    $number=0;
                    while($row = mysqli_fetch_assoc($result)){
                        $payment_id = $row['payment_id'];
                        $order_id = $row['order_id'];
                        $invoice_number = $row['invoice_number'];
                        $amount = $row['amount'];
                        $payment_mode = $row['payment_mode'];
                        $order_date = $row['date'];
                        $number++;
                    
                        echo "<tr>
                                <td>$number</td>
                                <td>$invoice_number</td>
                                <td>$amount</td>
                                <td>$payment_mode</td>
                                <td>$order_date</td>
                                <td>
                                    <a href='index.php?delete-payment'><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>";
                    }
                    
                }
        ?>

        </tbody>
</table>