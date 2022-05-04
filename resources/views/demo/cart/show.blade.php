
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Show Cart</title>
</head>

<body>
    <div class="container">
        <div class='row'>
            <div class='col-12'>
                <h1 class='text-center'>Show Cart</h1>
                <p>
                    Hiện tại có {{Cart::count()}} sản phẩm trong giỏ hàng
                </p>
                <form action="{{route('cart.update')}}" method='post'>
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach(Cart::content() as $row) :?>

                                <tr>
                                    <td>
                                        <p><strong><?php echo $row->name; ?></strong></p>
                                        <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>
                                    </td>
                                    <td><input type="number" min='1' name='qty[{{$row->rowId}}]' value="<?php echo $row->qty; ?>"></td>
                                    <td>{{number_format($row->price,0,',','.')}} đ</td>
                                    <td>$<?php echo $row->total; ?></td>
                                </tr>

                            <?php endforeach;?>

                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td>Subtotal</td>
                                <td><?php echo Cart::subtotal(); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td>Total</td>
                                <td><?php echo Cart::total(); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Cập nhật giỏ hàng" name='btn_update' class='btn btn-primary'>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
</body>

</html>
