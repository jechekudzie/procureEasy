@extends('layouts.admin')

@push('head')

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endpush

@section('content')

    <div class="pb-5">
        <div class="row g-4">
            <div class="col-12 col-xxl-12">
                <div class="mb-8">
                    <h2 class="mb-2">ProcureEasy - Suppliers</h2>

                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#verticallyCentered"><i class="fa-solid fa-plus me-2"></i> Add Supplier
                    </button>
                </div>

                <br/>
                <div id="messageContainer"></div>
                <div id="errorContainer"></div>
                <!-- Start custom content -->
                <div class="row g-4">
                    <div class="col-8 col-xl-8">
                        @if(session()->has('errors'))
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <!-- Success Alert -->
                                    <div class="alert alert-outline-danger d-flex align-items-center" role="alert">
                                        <span class="fas fa-times-circle text-danger fs-3 me-3"></span>
                                        <p class="mb-0 flex-1"> {{ $error }}!</p>

                                        <button class="btn-close" type="button" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endforeach

                            @endif
                        @endif
                        @if(session('success'))
                            <div class="alert alert-outline-success d-flex align-items-center" role="alert">
                                <span class="fas fa-check-circle text-success fs-3 me-3"></span>
                                <p class="mb-0 flex-1"> {{ session('success') }}</p>

                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-xl-12">
                        <div class="mb-9">
                            <div class="card shadow-none border border-300 my-4"
                                 data-component-card="data-component-card">
                                <div class="card-header p-4 border-bottom border-300 bg-soft">
                                    <div class="row g-3 justify-content-between align-items-center">
                                        <div class="col-12 col-md">
                                            <h4 class="text-900 mb-0 card-title" data-anchor="data-anchor">Andrelin
                                                Enterprises - Suppliers </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-4 code-to-copy">
                                        <div>
                                            <div class="table-responsive">
                                                <table id="buttons-datatables"
                                                       class="table table-striped flex-wrap table-sm fs--1 mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th class="sort border-top ps-3" data-sort="id">Id</th>
                                                        <th class="sort border-top ps-3" data-sort="name">Name</th>
                                                        <th class="sort border-top" data-sort="type">Email</th>
                                                        <th class="sort border-top" data-sort="type">Mobile</th>
                                                        <th class="sort border-top" data-sort="type">Telephone</th>
                                                        <th class="sort border-top" data-sort="type">WhatsApp</th>
                                                        <th class="sort border-top" data-sort="type">Address</th>
                                                        <th class="sort border-top" data-sort="type">Website</th>
                                                        <th class="sort border-top" data-sort="type">Product Line</th>
                                                        <th class="border-top">Action
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                    @foreach($suppliers as $supplier)
                                                        <tr>
                                                            <td class="align-middle ps-3 ">{{$supplier->id}}</td>
                                                            <td class="align-middle ps-3 ">{{$supplier->name}}</td>
                                                            <td class="align-middle ps-3 ">{{$supplier->email}}</td>
                                                            <td class="align-middle ps-3 ">{{$supplier->mobile}}</td>
                                                            <td class="align-middle ps-3 ">{{$supplier->telephone}}</td>
                                                            <td class="align-middle ps-3 ">{{$supplier->whatsapp}}</td>
                                                            <td class="align-middle ps-3 ">{{$supplier->physical_address}}</td>
                                                            <td class="align-middle ps-3 ">{{$supplier->web_address}}</td>
                                                            <td class="align-middle ps-3 ">
                                                                <a href="{{route('suppliers.product-lines.index',$supplier->slug)}}"> Product Lines ({{$supplier->supplierProductLines()->count()}}) </a>
                                                            </td>

                                                            <td class="align-middle ps-3">
                                                                <!-- Edit Button -->
                                                                <a style="display: inline-block;"
                                                                   href="#"
                                                                   class="edit-button btn btn-outline-primary btn-sm me-1 mb-1"
                                                                   data-name="{{ $supplier->name }}"
                                                                   data-email="{{ $supplier->email }}"
                                                                   data-mobile="{{ $supplier->mobile }}"
                                                                   data-telephone="{{ $supplier->telephone }}"
                                                                   data-whatsapp="{{ $supplier->whatsapp }}"
                                                                   data-physical_address="{{ $supplier->physical_address }}"
                                                                   data-web_address="{{ $supplier->web_address }}"
                                                                   data-slug="{{ $supplier->slug }}" title="Edit"
                                                                   data-mode="edit"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#verticallyCentered">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <!-- Delete Button -->
                                                                <form
                                                                    action="{{ route('suppliers.destroy', $supplier->slug) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure?');"
                                                                    style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            class="btn btn-outline-danger btn-sm me-1 mb-1"
                                                                            title="Delete">
                                                                        <i class="fa fa-trash"> </i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <div class="modal fade" id="verticallyCentered" tabindex="-1"
                                                     aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true"
                                                     style="display: none;">
                                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="verticallyCenteredModalLabel">Add Supplier</h5>
                                                                <button class="btn p-1" type="button"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                    <svg class="svg-inline--fa fa-xmark fs--1"
                                                                         aria-hidden="true" focusable="false"
                                                                         data-prefix="fas" data-icon="xmark" role="img"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         viewBox="0 0 320 512" data-fa-i2svg="">
                                                                        <path fill="currentColor"
                                                                              d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                                                                    </svg>
                                                                    <!-- <span class="fas fa-times fs--1"></span> Font Awesome fontawesome.com -->
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <form id="supplier-form" action="{{route('suppliers.store')}}" method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="_method" value="POST">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <!-- Name Field -->
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label" for="name">Supplier Name</label>
                                                                            <input class="form-control" name="name" id="name" type="text" placeholder="Enter supplier name"/>
                                                                        </div>

                                                                        <!-- Email Field -->
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label" for="email">Email Address</label>
                                                                            <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address"/>
                                                                        </div>

                                                                        <!-- Mobile Field -->
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label" for="mobile">Mobile Number</label>
                                                                            <input class="form-control" name="mobile" id="mobile" type="tel" placeholder="Enter mobile number"/>
                                                                        </div>

                                                                        <!-- Telephone Field -->
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label" for="telephone">Telephone Number</label>
                                                                            <input class="form-control" name="telephone" id="telephone" type="tel" placeholder="Enter telephone number"/>
                                                                        </div>

                                                                        <!-- WhatsApp Field -->
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label" for="whatsapp">WhatsApp Number</label>
                                                                            <input class="form-control" name="whatsapp" id="whatsapp" type="tel" placeholder="Enter WhatsApp number"/>
                                                                        </div>

                                                                        <!-- Physical Address Field -->
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label" for="physical_address">Physical Address</label>
                                                                            <textarea class="form-control" name="physical_address" id="physical_address" rows="2" placeholder="Enter physical address"></textarea>
                                                                        </div>

                                                                        <!-- Web Address Field -->
                                                                        <div class="mb-3 col-md-4">
                                                                            <label class="form-label" for="web_address">Web Address</label>
                                                                            <input class="form-control" name="web_address" id="web_address" type="url" placeholder="Enter web address eg. https://leadingdigital.africa"/>
                                                                        </div>

                                                                    </div>

                                                                    <!-- Submit Button -->
                                                                    <div class="col-12">
                                                                        <button id="submit-button" class="btn btn-primary w-100">Add New Supplier</button>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                            <div class="modal-footer">
                                                                {{--<button class="btn btn-primary" type="button">Okay</button>--}}
                                                                <button class="btn btn-outline-primary" type="button"
                                                                        data-bs-dismiss="modal">Cancel
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- end custom content -->

            </div>
        </div>
    </div>

    <script>

    </script>

@endsection

@push('scripts')
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>


    <script>
        <!-- datatable js -->
        document.addEventListener("DOMContentLoaded", function () {
            $('#buttons-datatables').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'print', 'pdf']
            });
        });

        // Assuming you have jQuery available
        $(document).ready(function () {
            $('#verticallyCentered').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var modal = $(this);
                var mode = button.data('mode'); // Check if the button has a 'mode' data attribute

                // Clear form fields first, in case it's an 'Add' action or to reset from previous 'Edit'
                modal.find('.modal-title').text('Add Supplier');
                modal.find('#name, #email, #mobile, #telephone, #whatsapp, #physical_address, #web_address').val('');
                modal.find('#submit-button').text('Add New');

                // If the trigger button is for 'Edit', fill the form with existing data
                if (mode === 'edit') {
                    // Fetch data from the button's data-* attributes for 'Edit'
                    var name = button.data('name');
                    var email = button.data('email');
                    var mobile = button.data('mobile');
                    var telephone = button.data('telephone');
                    var whatsapp = button.data('whatsapp');
                    var physical_address = button.data('physical_address');
                    var web_address = button.data('web_address');
                    var slug = button.data('slug');

                    // Update the modal's content for 'Edit'
                    modal.find('.modal-title').text('Edit Supplier - ' + name);
                    modal.find('#name').val(name);
                    modal.find('#email').val(email);
                    modal.find('#mobile').val(mobile);
                    modal.find('#telephone').val(telephone);
                    modal.find('#whatsapp').val(whatsapp);
                    modal.find('#physical_address').val(physical_address);
                    modal.find('#web_address').val(web_address);
                    modal.find('#submit-button').text('Update Supplier Details');

                    // Update form action and method for 'Edit'
                    $('input[name="_method"]').val('PATCH');
                    modal.find('#supplier-form').attr('action', '/admin/suppliers/' + slug + '/update');
                }

                // Fade out alerts after 5 seconds
                setTimeout(function () {
                    $('.alert').fadeOut('slow', function () {
                        $(this).remove();
                    });
                }, 5000);
            });

            // Additional initialization can go here
        });




    </script>

@endpush
