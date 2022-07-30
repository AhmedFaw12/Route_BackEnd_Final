<?php  require_once("inc/header.php");?>
    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All Orders</h3>
                </div>

                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Total</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Kareem Fouad</td>
                        <td>01012345678</td>
                        <td>$15000</td>
                        <td>2020-10-11</td>
                        <td>pending</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="#">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                      </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php  require_once("inc/footer.php");?>