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
                    <h2 class="mb-2">Company overview</h2>
                    <h5 class="text-700 fw-semi-bold">The hierarchy for ProcureEasy.</h5>
                </div>
                <div class="col-auto">

                    <a class="btn btn-primary px-5" href="{{route('admin.organisations.index')}}">
                        <i class="fa-solid fa-plus me-2"></i>
                        Add new organisation
                    </a>
                </div>

                <br/>
                <div id="messageContainer"></div>
                <div id="errorContainer"></div>
                <!-- Start custom content -->
                <div class="row g-4">

                    <div class="col-md-12 col-xl-12">
                        <div class="mb-9">
                            <div class="card shadow-none border border-300 my-4"
                                 data-component-card="data-component-card">
                                <div class="card-header p-4 border-bottom border-300 bg-soft">
                                    <div class="row g-3 justify-content-between align-items-center">
                                        <div class="col-12 col-md">
                                            <h4 class="text-900 mb-0 card-title" data-anchor="data-anchor"> Company Hierarchy</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-4 code-to-copy">

                                        <div>
                                            <div class="table-responsive">
                                                <table id="buttons-datatables"
                                                       class="table table-striped table-sm fs--1 mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th class="sort border-top ps-3" data-sort="name">Name</th>
                                                        <th class="sort border-top" data-sort="type">Parent
                                                            Organisation
                                                        </th>
                                                        <th class="sort border-top" data-sort="age">Type</th>
                                                        <th class="sort border-top" data-sort="age">Roles</th>
                                                        <th class="sort border-top" data-sort="age">Users</th>
                                                        <th class="border-top">Action
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                    @foreach($organisations as $organisation)
                                                        <tr>
                                                            <td class="align-middle ps-3 ">{{$organisation->name}}</td>
                                                            <td class="align-middle ps-3">{{$organisation->parentOrganisation->name ?? ''}}</td>
                                                            <td class="align-middle ps-3">{{$organisation->organisationType->name}}</td>
                                                            <td><a href="{{route('admin.organisation-roles.index',$organisation->slug)}}">Manage ({{$organisation->organisationRoles->count()}})</a></td>
                                                            <td><a href="{{route('admin.organisation-users.index',$organisation->slug)}}">Manage ({{$organisation->users->count()}})</a></td>
                                                            <td class="align-middle ps-3">
                                                                <!-- Edit Button -->
                                                                <a href="javascript:void(0);" class="edit-button btn btn-outline-primary btn-sm me-1 mb-1"
                                                                   data-name="{{ $organisation->name }}"
                                                                   data-slug="{{ $organisation->slug }}" title="Edit">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <!-- Delete Button -->
                                                                <form
                                                                    action="{{ route('admin.organisations.destroy', $organisation->slug) }}"
                                                                    method="POST" onsubmit="return confirm('Are you sure?');"
                                                                    style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-outline-danger btn-sm me-1 mb-1" title="Delete">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
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

    <script>
        <!-- datatable js -->
        document.addEventListener("DOMContentLoaded", function () {
            $('#buttons-datatables').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'print', 'pdf']
            });
        });

    </script>

@endpush
