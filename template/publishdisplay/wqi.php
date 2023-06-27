<script>
htall.include('layout/publish.html')
</script>
<div id="extend">
    <?php
            include './../admin/conn/conn.php';
            global $conn;
            session_start();
            
            $_SESSION['year'] = date('Y');
            if(isset($_POST['year']) || isset($_POST['quarter'])){
                $year = $_POST['year'];
                $quarter = $_POST['quarter'];
                $_SESSION['year'] = $year;
                $_SESSION['quarter'] = $quarter;
            
            
            }else{
                $year = '';
                $quarter = '';
            }
        ?>
    <div class="col-md-12 m-0 p-0 bg-light bg-opacity-50 rounded shadow-lg overflow-auto">
        <div class="border col-md-4 shadow-lg p-2 text-dark">
            Water Quality Classification Scale:<br>0-25 ........ Excellent<br>26-50 ........ Good<br>51-75 ........
            Bad<br>76-100 ........ Very Bad<br>100 & above ........ Unfit<br>
        </div>
        <div class="p-2">
            <table id="employeeTable" class="table table-hover border-dark table-bordered">
                <thead>
                    <tr>
                        <th colspan="15" class="text-center">WATER QUALITY INDEX</th>
                    </tr>
                    <tr>
                        <th colspan="15" class="text-center">
                            <form method="post">
                                <div class="row g-3 col-md-12 d-flex justify-content-center">
                                    <div class="col-md-auto mb-2">
                                        <span>CY </span>
                                    </div>
                                    <div class="col-md-auto mb-2">

                                        <select type="text" name="year" onchange="this.form.submit()"
                                            class="form-select" id="validationRegion" required>

                                            <?php
                                                        $CY = date('Y');
                                                        for ($x = 1; $x <= $CY; $CY--) {

                                                            if($CY == $_SESSION['year']){
                                                                echo "<option selected>$CY</option>";    
                                                            }else{
                                                                echo "<option>$CY</option>";
                                                            }
                                                        }
                                                        ?>

                                        </select>
                                    </div>
                                </div>
                            </form>
                        </th>
                    </tr>
                    <tr>
                        <th class="align-middle ">Region</th>
                        <th class="align-middle">Sta. ID</th>
                        <th class="align-middle">Jan</th>
                        <th class="align-middle">Feb</th>
                        <th class="align-middle">Mar</th>
                        <th class="align-middle">Apr</th>
                        <th class="align-middle">May</th>
                        <th class="align-middle">Jun</th>
                        <th class="align-middle">Jul</th>
                        <th class="align-middle">Aug</th>
                        <th class="align-middle">Sep</th>
                        <th class="align-middle">Oct</th>
                        <th class="align-middle">Nov</th>
                        <th class="align-middle">Dec</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <script>
            $(function(){
                var data =(year)=>{
                    tbody = htall.getData({url:'route/publicwqidata',data:{year:year}})
                    console.log(tbody)
                    $("tbody").html(tbody.tbody)
                }
                data($("#validationRegion").val())
                $("#validationRegion").change(function(){
                    data($(this).val())
                })
            })
        </script>

    </div>
</div>