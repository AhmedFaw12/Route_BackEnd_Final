<?php  require_once("inc/header.php");?>

    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Show Order : id here</h3>
                <div class="card">
                    <div class="card-body p-5">
                        <table class="table table-bordered">
                            <thead>
                                <th colspan="2" class="text-center">Customer</th>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">Name</th>
                                <td>kareem fouad</td>
                              </tr>
                              <tr>
                                <th scope="row">Email</th>
                                <td>kareem@techstore.com</td>
                              </tr>
                              <tr>
                                <th scope="row">Phone</th>
                                <td>01012345678</td>
                              </tr>
                              <tr>
                                <th scope="row">Address</th>
                                <td>15 nasr city, cairo, Egypt</td>
                              </tr>
                              <tr>
                                <th scope="row">Time</th>
                                <td>2020-12-06</td>
                              </tr>
                              <tr>
                                <th scope="row">Status</th>
                                <td>pending</td>
                              </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Lenovo ideapad</td>
                                <td>2</td>
                                <td>$10000</td>
                              </tr>
                              <tr>
                                <td>Samsung note</td>
                                <td>1</td>
                                <td>$2000</td>
                              </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th>Change Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>$22000</td>
                                <td>
                                    <a class="btn btn-success" href="#">Approve</a>
                                    <a class="btn btn-danger" href="#">Cancel</a>
                                </td>
                              </tr>
                            </tbody>
                        </table>

                        <a class="btn btn-dark" href="#">Back</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php  require_once("inc/footer.php");?>