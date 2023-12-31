@extends('layoutBack')

@section('body')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Complaint</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/staffs/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/staffs/chats/appointment/viewAppointment">Automated Chat</a></li>
                    <li class="breadcrumb-item active">Complaint</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="search-bar col-lg-2 mb-3 d-flex">
            <div class="ml-auto">
                <form class="search-form d-flex align-items-center" method="GET"
                    action="/staffs/chats/complaint/viewComplaintSearch">
                    @csrf
                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </div><!-- End Search Bar -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Complaint <span>(Result count: {{ $complaintsCount }})</span></h5>
                        @php
                            $count = $complaints->firstItem();
                        @endphp
                        <!-- Default Table -->
                        <table class="table" id="complaintTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">File At</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Updated By</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $complaint)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $complaint->title }}</td>
                                        <td>{{ $complaint->description }}</td>
                                        <td>{{ $complaint->created_at }}</td>
                                        <td>{{ $complaint->status }}</td>
                                        <td>{{ $complaint->updated_by }}</td>
                                        <td>{{ $complaint->updated_at }}</td>
                                        <td style="text-align: center;"><span class="fa fa-eye" style="cursor: pointer;"
                                                onclick="showDetails('{{ $complaint->remarks }}')"></span></td>
                                        <td>
                                            <form method="post" action="/staffs/chats/complaint/solved" class="d-inline"
                                                id="solvedForm">
                                                @csrf
                                                <input type="hidden" name="comp_id" id="solvedCompId" value="{{ $complaint->comp_id }}">
                                                <input type="hidden" name="remarks" id="solvedRemarksInput">
                                                <button type="button" id="approvedBtn" class="action" title="Solved"
                                                    onclick="showSolvedPrompt('{{ $complaint->comp_id }}')">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>

                                            <form method="post" action="/staffs/chats/complaint/invalid" class="d-inline"
                                                id="invalidForm">
                                                @csrf
                                                <input type="hidden" name="comp_id" id="invalidCompId" value="{{ $complaint->comp_id }}">
                                                <input type="hidden" name="remarks" id="invalidRemarksInput">
                                                <button type="button" id="delBtn" class="action" title="Invalid"
                                                    onclick="showInvalidPrompt('{{ $complaint->comp_id }}')">
                                                    <i class="fa-solid fa-ban"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center custom-pagination">
                            {{ $complaints->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $('#chatNav').removeClass('collapsed');
            $('#complaint').addClass('active');
            $('#chat-nav').addClass('show');

            $('#complaintTable').DataTable({
                paging: false, // Disable pagination
                searching: false, // Disable search
                info: false // Disable information display
            });
        });

        // style
        const SwalStyledButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-secondary',
            },
            buttonsStyling: false
        })

        function redirectToPage(button) {
            const url = button.getAttribute('data-get');
            window.location.href = url;
        }

        function showSolvedPrompt(compId) {
            Swal.fire({
                title: 'Mark Complaint as Solved',
                html: '<input id="solvedRemarks" class="swal2-input" placeholder="Enter remarks" type="textarea">',
                confirmButtonText: 'Mark as Solved',
                showCancelButton: true,
                preConfirm: () => {
                    const remarks = document.getElementById('solvedRemarks').value;
                    if (!remarks) {
                        Swal.showValidationMessage('Remarks are required.');
                    }
                    return {
                        remarks: remarks,
                        compId: compId
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('solvedCompId').value = compId;
                    document.getElementById('solvedRemarksInput').value = result.value.remarks;
                    document.getElementById('solvedForm').submit();
                }
            });
        }

        function showInvalidPrompt(compId) {
            Swal.fire({
                title: 'Mark Complaint as Invalid',
                html: '<input id="invalidRemarks" class="swal2-input complaintRemark" placeholder="Enter remarks" type="textarea">',
                confirmButtonText: 'Mark as Invalid',
                showCancelButton: true,
                preConfirm: () => {
                    const remarks = document.getElementById('invalidRemarks').value;
                    if (!remarks) {
                        Swal.showValidationMessage('Remarks are required.');
                    }
                    return {
                        remarks: remarks,
                        compId: compId
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('invalidCompId').value = compId;
                    document.getElementById('invalidRemarksInput').value = result.value.remarks;
                    document.getElementById('invalidForm').submit();
                }
            });
        }

        function showDetails(remarks) {
            Swal.fire({
                title: 'Remarks',
                text: remarks,
                icon: 'info',
                confirmButtonText: 'Close'
            });
        }
    </script>
@endsection
