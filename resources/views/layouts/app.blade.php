<html>

<head>
    <title>DTP - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <style>
        .btn-remove{
            margin-top:5px;
        }
    </style>

</head>

<body>
    @section('sidebar')

    @show

    <div class="container" style="margin-top:40px;">
        @yield('content')
    </div>
    
    <script>
        $(document).ready(function(){
            $(".btn-remove").click(function(){
                var t = $(this);
                var t_row = t.parents('tr.row-remove');
                t_row.remove();
            });

            $(".btn-add").click(function(){
                var t = $(this);
                var table = t.parents('.parent-add').find('table.table');
                if(table.hasClass('table-pendidikan')){
                    table.find("tbody").append(`
                        <tr class="row-remove">
                            <td>
                                <input name="nama_sekolah[]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="jurusan[]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="tahun_masuk[]" type="number" class="form-control">
                            </td>
                            <td style="text-align:center;">
                                <input name="tahun_lulus[]" type="number" class="form-control">
                                <button type="button" class="btn btn-remove btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `);
                }else{
                    table.find("tbody").append(`
                        <tr class="row-remove">
                            <td>
                                <input name="perusahaan[]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="jabatan[]" type="text" class="form-control">
                            </td>
                            <td>
                                <input name="tahun[]" type="number" class="form-control">
                            </td>
                            <td style="text-align:center;">
                                <input name="keterangan[]" type="text" class="form-control">
                                <button type="button" class="btn btn-remove btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    `);
                }
            });
        });
    </script>
</body>

</html>