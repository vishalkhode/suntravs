
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List Destinations
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Destinations</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status </th>
                                    <th>Sort Order<?php //echo $this->getDestination_SortOrder($data);?></th>
                                    <th>Created Date</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                               <?php  foreach($model as $data ){
                                $date = date_create($data->date_added);
                                ?>
                                <tr>
                                    <td> <?php echo $data->name ?></td>
                                    <td><?php echo $this-> getstatuschanged($data);?></td>
                                    <td><?php echo $data->sort_order ?></td>
                                    <td> <?php echo DATE_FORMAT($date,'jS F Y g:ia')?></td>
                                </tr>
                                <?php } ?>
                        
                            </tbody>
<!--                            <tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    
                                </tr>
                            </tfoot>-->
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>

<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>