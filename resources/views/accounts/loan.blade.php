@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body"> 
          <h1>Account Number: {{$account->id}}, {{$account->name}}</h1>
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif
           <ul class="nav nav-tabs">
              <li class="nav-item active"><a class="nav-link" data-toggle="tab" href="#details">Account Details  </a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#add_loans"> Add Loan  </a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#record_payment">Record payment  </a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#view_loans"> View Loans  </a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clientnotes"> Client notes  </a></li>
             </ul>

            <div class="tab-content">
              <div id="details" class="tab-pane active">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Refree</button>

                  <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Add refree</h4>
                      </div>
                      <div class="modal-body">
                        <label>Name</label>
                        <input type="text" id="name" class="form-control">

                        <label>Phone number</label>
                        <input type="text" id="phone_number" class="form-control">

                        <label>ID number</label>
                        <input type="text" id="national_id" class="form-control">
                        <br>
                        <button id="save_refree" class="btn btn-primary"><span id="btntext">Save</span></button>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
 

                <h3>Account Details</h3>
                <table class="table table-hover">
                    <tr class="info">
                        <td>Account Name</td> <td><span style="text-transform: capitalize;">{{$account->name}}</span></td>
                    </tr>

                    <tr class="danger">
                        <td>Account Number</td> <td>{{$account->id}}</td>
                    </tr>

                    <tr class="success">
                        <td>Account Phone Number</td> <td>{{$account->phone_number}}</td>
                    </tr>                    

                    <tr class="success">
                        <td>Business</td> <td>{{$account->business}}</td>
                    </tr>

                </table>             
              </div>

              <div id="add_loans" class="tab-pane fade">
                <h3>Add New Loan to account</h3>
                <br>
                <form method="POST" action="{{route('loan.store')}}">
                    @csrf
                    <input type="hidden" name="account_id" value="{{$account->id}}">
                    <label>Principal</label>
                    <input type="text" name="principal" class="form-control number">

                    <label>Profit expected</label>
                    <input type="text" name="rate" class="form-control number">

                    <label>Repayment date</label>
                    <input type="date" name="date_of_payment" class="form-control">

                    <label>Description</label>
                    <textarea name="particular" class="form-control" placeholder="Optional"></textarea>
                    <br><br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                              
              </div>
              <div id="view_loans" class="tab-pane fade">
                <h3>View Loans</h3>
                 <div class="table-responsive">

                    <table class="table table-hover" id="table_display">
                        <thead>
                            <th>#</th>
                            <th>Date</th> 
                            <th>Repayment date</th>
                            <th>Particular</th>
                            <th>Principal(UGX)</th> 
                            <th>Profit(UGX)</th>
                            <th>Expected(UGX)</th>
                            <th>Status</th>
                            <th>Details</th>
                        </thead>

                        <tbody>
                            @foreach($account->loan as $loans)
                             <tr>
                                 <td>{{$loans->id}}</td>
                                 <td>{{$loans->created_at}}</td>
                                 <td>{{$loans->date_of_payment}}</td>
                                 <td>{{$loans->particular}}</td>
                                 <td>{{number_format($loans->principal)}}</td>
                                 <td>{{number_format($loans->rate)}}</td>
                                 <td>
                                    {{number_format($loans->principal + $loans->rate)}}
                                 </td>
                                 <td>
                                    @if($loans->status == 1)
                                      <span class="text-warning">Pending</span>
                                      @else
                                      <span class="text-success">Complete</span>
                                    @endif
                                  </td>

                                 <td>
                                     <a class="btn btn-primary" href="{{route('loan.show',$loans->id)}}">Details</a>
                                 </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                     
                </div>
             
              </div>

              <div id="record_payment" class="tab-pane fade">
                <h3>Record loan payment</h3>
                <form method="POST" action="{{route('payment.store')}}">
                    @csrf
                    <label>Choose Loan</label>
                    <select class="form-control" name="loan_id">
                        <option></option>
                        @foreach($pending_loans as $loans)
                            <option value="{{$loans->id}}">{{number_format($loans->principal)}} ({{$loans->created_at}})</option>
                        @endforeach
                    </select>
                    <label>Deposited amount</label>
                    <input type="text" name="amount" class="form-control number">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>                 
              </div>

               <div id="clientnotes" class="tab-pane fade">
                <h3>Client notes</h3>

                <form action="{{route('notes.store')}}" method="POST">
                  @csrf
                  <label>Notes</label>
                  <textarea name="notes" class="form-control"></textarea>
                  <input type="hidden" name="account_id" value="{{$account->id}}">
                  <br><br>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>
                <br><br>

                <ol>
                  @foreach($notes as $note)
                    <li>
                      <p>{{$note->notes}}</p>

                      <br>
                      Date: <span>{{$note->created_at}}</span>
                    </li>
                  @endforeach
                </ol>                 
                 
              </div>

            </div>
        </div>
    </div> 
</div>
@endsection 
@push('scripts')
<script src="{{ asset('js/app.js') }}"></script>
 <script type="text/javascript">  
    $('input.number').keyup(function(event) {
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
    });
</script>

<script>
      $("#save_refree").click(function() {
        $("#save_refree").prop("disabled", true);
        $("#btntext").html("Processing...");
        $.ajax({
                type: "POST",
                url: "{{ route('refree.store') }}",
            data: {
                name: $("#name").val(),
                national_id: $("#national_id").val(),
                phone_number: $("#phone_number").val(),
                account_id: {{$account->id}},
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result);
                    $("#name").val(" ");
                    $("#national_id").val(" ");
                    $("#phone_number").val(" ");
                    $("#save_refree").removeAttr('disabled');
                    $("#btntext").html("Add new");               
                }
        })
    });
</script>
@endpush
@include('layouts.datatable')



