<?php
require_once '../bootstrap.php';
use CT275\Labs\Comic;
$Comic = new Comic($PDO);
$Comics = $Comic->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comics</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">     
    <link href="/css/sticky-footer.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">   
</head>
<body>
    <?php foreach($Comics as $Comic): ?>

<?php endforeach ?>
    <?php include('../partials/navbar.php') ?>

    <!-- Main Page Content --> 
    <div class="container"> 
        <section id="inner" class="inner-section section">
                <!-- SECTION HEADING -->
                <h2 class="section-heading text-center wow fadeIn" data-wow-duration="1s">Đọc Truyện</h2>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <p class="wow fadeIn" data-wow-duration="2s">Tất cả truyện.</p>
                    </div>
                </div>

                <div class="inner-wrapper row">
                    <div class="col-md-12">

                        <a href="/add.php" class="btn btn-primary" style="margin-bottom: 30px;">
                            <i class="fa fa-plus"></i> Thêm truyện</a>

                        <!-- Table Starts Here -->
                        <table id="Comics" class="table table-bordered table-responsive table-striped">
                            <thead>
                                <tr> 
                                    <th>Tên Truyện</th>
                                    <th>Tác Giả</th>
                                    <th>Ngày Đăng</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($Comics as $Comic): ?>
                            <tr>
<td><?=htmlspecialchars($Comic->name)?></td>
<td><?=htmlspecialchars($Comic->tacgia)?></td>
<td><?=date("d-m-Y", strtotime($Comic->created_at))?></td>
<td><?=htmlspecialchars($Comic->notes)?></td>


<td>
<a href="/chapter.php?id=<?=$Comic->getId()?>"
class="btn btn-xs btn-success">
<i alt="chapter" class="fa fa-pencil">View</i></a>
<a href="/edit.php?id=<?=$Comic->getId()?>"

class="btn btn-xs btn-warning">
<i alt="Edit" class="fa fa-pencil"> Edit</i></a>
<form class="delete" action="/delete.php"
method="POST" style="display: inline;">
<input type="hidden" name="id"
value="<?=$Comic->getId()?>">
<button type="submit" class="btn btn-xs btn-danger"
name="delete-Comic">
<i alt="Delete" class="fa fa-trash"> Delete</i></button>
</form>

</td>

                            </tr>
<?php endforeach ?>
                            </tbody>

                            <div id="delete-confirm" class="modal fade" role="dialog">"
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close"
data-dismiss="modal">&times;</button>
<h4 class="modal-title">Confirmation</h4>
</div>
<div class="modal-body">Do you want to delete this Comic?</div>
<div class="modal-footer">
<button type="button" data-dismiss="modal"
class="btn btn-danger" id="delete">Delete</button>
<button type="button" data-dismiss="modal"
class="btn btn-default">Cancel</button>
</div>
</div>
</div>
</div>
       



                        </table>
                        <!-- Table Ends Here -->
                    </div>
                </div>
        </section>
    </div>

    <?php include('../partials/footer.php') ?>    

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script>
        $(document).ready(function(){
            new WOW().init();
            $('#Comics').DataTable();   
            $('button[name="delete-Comic"]').on('click', function(e){
var $form=$(this).closest('form');
e.preventDefault();
$('#delete-confirm').modal({

    backdrop: 'static', keyboard: false
})
.one('click', '#delete', function() {
$form.trigger('submit');
});

        });
    </script>
</body>
</html>
