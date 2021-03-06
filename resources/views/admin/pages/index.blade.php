@extends('admin.master')
@section('title','Menu')
@section('css')
<link rel="stylesheet" href="{{asset('@styleadmin/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<style type="text/css">
        button {
                height: 40px;
            }
        .cf:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
    
        * html .cf {
            zoom: 1;
        }
    
        *:first-child+html .cf {
            zoom: 1;
        }
    
        html {
            margin: 0;
            padding: 0;
        }
    
        body {
            font-size: 100%;
            margin: 0;
            padding: 1.75em;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
    
        h1 {
            font-size: 1.75em;
            margin: 0 0 0.6em 0;
        }
    
        a {
            color: #2996cc;
        }
    
        a:hover {
            text-decoration: none;
        }
    
        p {
            line-height: 1.5em;
        }
    
        .small {
            color: #666;
            font-size: 0.875em;
        }
    
        .large {
            font-size: 1.25em;
        }
    
        /**
     * Nestable
     */
    
        .dd {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            max-width: 600px;
            list-style: none;
            font-size: 13px;
            line-height: 20px;
        }
    
        .dd-list {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
        }
    
        .dd-list .dd-list {
            padding-left: 30px;
        }
    
        .dd-collapsed .dd-list {
            display: none;
        }
    
        .dd-item,
        .dd-empty,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
            font-size: 13px;
            line-height: 20px;
        }
    
        .dd-handle {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
    
        .dd-handle:hover {
            color: #2ea8e5;
            background: #fff;
        }
    
        .dd-item>button {
            display: block;
            position: relative;
            cursor: pointer;
            float: left;
            width: 25px;
            height: 20px;
            margin: 5px 0;
            padding: 0;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 0;
            background: transparent;
            font-size: 12px;
            line-height: 1;
            text-align: center;
            font-weight: bold;
        }
    
        .dd-item>button:before {
            content: '+';
            display: block;
            position: absolute;
            width: 100%;
            text-align: center;
            text-indent: 0;
        }
    
        .dd-item>button[data-action="collapse"]:before {
            content: '-';
        }
    
        .dd-placeholder,
        .dd-empty {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
    
        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }
    
        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999;
        }
    
        .dd-dragel>.dd-item .dd-handle {
            margin-top: 0;
        }
    
        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
        }
    
        /**
     * Nestable Extras
     */
    
        .nestable-lists {
            display: block;
            clear: both;
            padding: 30px 0;
            width: 100%;
            border: 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
        }
    
        #nestable-menu {
            padding: 0;
            margin: 20px 0;
        }
    
        #nestable-output,
        #nestable2-output {
            width: 100%;
            height: 7em;
            font-size: 0.75em;
            line-height: 1.333333em;
            font-family: Consolas, monospace;
            padding: 5px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
    
        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background: linear-gradient(top, #bbb 0%, #999 100%);
        }
    
        #nestable2 .dd-handle:hover {
            background: #bbb;
        }
    
        #nestable2 .dd-item>button:before {
            color: #fff;
        }
    
        @media only screen and (min-width: 700px) {
    
            .dd {
                float: left;
                width: 48%;
            }
            .dd+.dd {
                margin-left: 2%;
            }
    
        }
    
        .dd-hover>.dd-handle {
            background: #2ea8e5 !important;
        }
    
        /**
     * Nestable Draggable Handles
     */
    
        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
    
        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff;
        }
    
        .dd-dragel>.dd3-item>.dd3-content {
            margin: 0;
        }
    
        .dd3-item>button {
            margin-left: 30px;
        }
    
        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
    
        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }
    
        .dd3-handle:hover {
            background: #ddd;
        }
    
        /**
     * Socialite
     */
    
        .socialite {
            display: block;
            float: left;
            height: 35px;
        }
    </style>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <div class="dd">
                    <ol class="dd-list">

                    </ol>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <table id="order-listing" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mô tả</th>
                                <th>Đường dẫn</th>
                                <th>Menu Cha</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>
        <div class="row">
            <button type="button" id="OpenPagesModal" class="btn btn-success btn-xs" data-toggle="modal" data-target="#PagesModal" data-whatever="@getbootstrap"><i class="mdi mdi-check"></i>Thêm mới</button>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="PagesModal" tabindex="-1" role="dialog" aria-labelledby="PagesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PagesLabel">Thêm mới danh mục con</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ModalForm">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tiêu đề : </label>
                        <input type="text" class="form-control" id="name" name="name">
                        <input type="hidden" id="txtId" name="txtId">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">đường dẫn : </label>
                        <input type="text" class="form-control" id="slug" name="slug">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                          <label for="">Hiển thị dưới cùng</label>
                          <select class="form-control" name="selFooter" id="selFooter">
                            <option value='1'>Có</option>
                            <option value='0'>Không</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Hiển thị trên cùng</label>
                            <select class="form-control" name="selMenu" id="selMenu">
                                <option value='1'>Có</option>
                                <option value='0'>Không</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer" id="PagesModalFooter">
            </div>
        </div>
    </div>
</div>
{{--End modal--}}
@endsection
@section('javascript')

<script src="https://dbushell.com/Nestable/jquery.nestable.js"></script>
<script>
    fetch_page();
    function fetch_page()
    {
            $.ajax({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
                method: 'GET',
                url: '{{route('pages.fetch')}}',
                dataType: 'json',
                success: function(data) {
                    $('.dd-list').html(data.table_data);
                },
                error: function(html, status) {
                    console.log(html.responseText);
                }
            });
    }


    $(document).ready(function(){
        $('#order-listing').DataTable({
        "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
        "iDisplayLength": 10,
        "language": { 
            "sProcessing":   "Đang xử lý...",
            "sLengthMenu":   "Xem _MENU_ mục",
            "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
            "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
            "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
            "sInfoFiltered": "(được lọc từ _MAX_ mục)",
            "sInfoPostFix":  "",
            "sSearch":       "Tìm:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Đầu",
                "sPrevious": "Trước",
                "sNext":     "Tiếp",
                "sLast":     "Cuối"
            }
        },
        "process" : true,
        "stateSave": true,
        "serverSide" : false,
        "ajax" : '{!!route('pages.fetchdb')!!}',
        "columns":[
            {data:'id',name:'id'},
            {data:'name',name:'name'},
            {data:'slug'},
            {data:'parent_id',name:'parent_id'},
            {data:'status'},
            {data:'action'}
        ]

        });
        $('#order-listing').each(function(){
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
        });
    });

    $('.dd').nestable({ /* config options */ });
    $('.dd').on('change', function() {
        var a = $('.dd').nestable('serialize');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
                method: 'POST',
                url: '{{route('pages.update')}}',
                data:{list:a},
                dataType: 'json',
                success: function(data) {
                    ToastSuccess(data.success);
                    $('#order-listing').DataTable().ajax.reload();
                    fetch_page();
                },
                error: function(html, status) {
                    console.log(html.responseText);
                }
            });
    });
    $('#OpenPagesModal').click(function(){
        $('#PagesLabel').html('Thêm mới trang');
        $('#PagesModalFooter').html('<button type="button" id="addPages" class="btn btn-success">Lưu</button><button type="button" id="addPages2" class="btn btn-success">Lưu & Đóng</button><button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>');
        $('#name').val('');
        $('#slug').val('');
        // Lưu
        $('#addPages').click(function(){
            addPages();
        });

        // Lưu và đóng
        $('#addPages2').click(function(){
            addPages();
            $('#name').val('');
            $('#slug').val('');
            $('#PagesModal').modal('hide');
        });
    
    });
    function addPages()
    {
        var datas = $('#ModalForm').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
                method: 'POST',
                url: '{{route('pages.store')}}',
                data:datas,
                success: function(data) {
                    ToastSuccess(data.success);
                    $('#order-listing').DataTable().ajax.reload(); 
                    fetch_page();
                },
                error: function(request, status) {
                    $.each(request.responseJSON.errors,function(key,val){
                        ToastError(val);
                    });
                }
        });
    }

    function addPages2()
    {
        var datas = $('#ModalForm').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
                method: 'POST',
                url: '{{route('pages.store')}}',
                data:datas,
                success: function(data) {
                    ToastSuccess(data.success);
                    $('#order-listing').DataTable().ajax.reload(); 
                    fetch_page();
                },
                error: function(request, status) {
                    $.each(request.responseJSON.errors,function(key,val){
                        ToastError(val);
                    });
                }
        });
    }

    $(document).on('click','.edited',function(){
        $('#PagesModal').modal('show');
        $('#PagesLabel').html('Sửa menu');
        $('#PagesModalFooter').html('<button type="button" id="editPages" class="btn btn-success">Lưu</button><button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>');
        var id = $(this).attr("data-id");
        var name = $(this).attr("data-name");
        var slug = $(this).attr("data-slug");
        var selFooter = $(this).attr("data-selfooter");
        var selMenu = $(this).attr("data-selmenu");
        $('#name').val(name);
        $('#slug').val(slug);
        $('#selFooter').val(selFooter);
        $('#selMenu').val(selMenu);

        $('#editPages').click(function(){
            editPages(id);
        });
    });

    function editPages(id)
    {
        var datas = 'name='+$('#name').val()+'&slug='+$('#slug').val()+'&selFooter='+$('#selFooter').val()+'&selMenu='+$('#selMenu').val()+'&id='+id;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: '{{route('pages.updaterecord')}}',
            data:datas,
            success: function(data) {
                    ToastSuccess(data.success);
                    $('#order-listing').DataTable().ajax.reload(); 
                    fetch_page();
                },
                error: function(request, status) {
                    $.each(request.responseJSON.errors,function(key,val){
                    ToastError(val);
                });
            }
        });
    }
</script>
<script src="{{asset('@styleadmin/node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('@styleadmin/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
@endsection