<script>
htall.include('layout/publish.html')
</script>
<div id="extend">
    <div id="print" class="bg-white p-4 rounded shadow-lg m-5">
        <h3 class="text-center">MONITORING DATA</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="21" class="text-center">SUMMARY REPPORT OF WATER QUALITY MONITORING DATA IN REGION XI</th>
                </tr>
                <tr>
                    <th colspan="21" class="text-center">CLASSIFICATION PROCESS</th>
                </tr>
                <tr>
                    <th colspan="21" clas
                    s="text-center">
                        <span>Quarter CY</span>
                        <select id="year" class="form-select">
                            <?php
                             $cy = date('Y');
                             for($x = 1950; $x < $cy-1; $cy--){
                                echo "<option>$cy</option>";
                             }
                            ?>
                        </select>
                    </th>
                </tr>
                <tr class="text-center">
                    <th>Region</th>
                    <th>Parameter</th>
                    <th>Stn. No.</th>
                    <th>Sta. ID</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    <th class="bg-primary">Ave</th>
                    <th class="bg-danger">Min</th>
                    <th class="bg-success">Max</th>
                    <th class="bg-secondary">Water Quality Guideline</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <script>
        $(function(){
            var getdata =()=>{
                data =  htall.getData({
                    url: 'route/publishData',
                    data: {year: $("#year").val()}
                })
                $("tbody").html(data.data)
            }
            getdata()
            $("#year").change(function(){
                getdata()
                console.log(getdata)
            })
        })
    </script>
</div>