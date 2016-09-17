<form action="edit_kpi.php" method="post" >   
    <div class="modal animated fade " id="edit_kpi_<?php echo $result_kpi["kpi_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขหัวข้อ KPI</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div style="width: 75%;margin: auto;">
                                <div class="form-group">
                                    <label class="pull-left">ชื่อหัวข้อKPI </label>
                                    <input type="text" class="form-control" name="kpi_name" placeholder="ชื่อหัวข้อKPI" value="<?php echo $result_kpi["kpi_name"]; ?>" >

                                </div>

                                <div class="form-group">
                                    <label class="pull-left">คำอธิบาย </label>
                                    <input type="text" class="form-control" name="kpi_description" placeholder="คำอธิบายKPI" value="<?php echo $result_kpi["kpi_description"]; ?>" >
                                </div>
                                <div class="form-group">
                                    <label class="pull-left">หน่วย </label>
                                    <input type="text" class="form-control" name="unit" placeholder="ระบุหน่วย" value="<?php echo $result_kpi["unit"]; ?>" >
                                </div>
                                <div class="form-group">
                                    <label class="pull-left">ระยะเวลา(เดือน)</label>
                                    <input type="text" class="form-control" name="time_period" placeholder="ระบุระยะเวลา" value="<?php echo $result_kpi["time_period"]; ?>" >
                                </div>
                                <div class="form-group">
                                    <label class="pull-left">กลุ่ม</label>
                                    <?php
                                    $sql_kpi_group = "SELECT * FROM kpi_group";
                                    $query_kpi_group = mysqli_query($conn, $sql_kpi_group);
                                    ?>
                                    <select class="form-control" name="kpi_group_id" required>
                                        <option value="" >--เลือกกลุ่ม--</option>
                                        <?php while ($result_kpi_group = mysqli_fetch_array($query_kpi_group, MYSQLI_ASSOC)) { ?>
                                            <option value="<?php echo $result_kpi_group["kpi_group_id"]; ?>" <?php
                                            if ($result_kpi["kpi_group_id"] == $result_kpi_group["kpi_group_id"]) {
                                                echo "selected";
                                            }
                                            ?> >
                                            <?php echo $result_kpi_group["kpi_group_id"] . " - " . $result_kpi_group["kpi_group_name"]; ?>
                                            </option>
                                    <?php } ?>
                                    </select>
                                </div>                                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-success" type="submit" name="submit" value="บันทึก" >
                    <input type="hidden" name="kpi_id" value="<?php echo $result_kpi["kpi_id"]; ?>" >
                    <input type="hidden" name="kpi_current_group_id" value="<?php echo $get_kpi_group_id; ?>" >
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                </div>                 
            </div>
        </div>  
    </div>
</form>