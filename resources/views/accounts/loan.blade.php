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
             </ul>

            <div class="tab-content">
              <div id="details" class="tab-pane active">

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

                    <label>Rate</label>
                    <input type="number" step="any" name="rate" class="form-control">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Save</button>


                    <label></label>
                </form>
                              
              </div>
              <div id="view_loans" class="tab-pane fade">
                <h3>View Loans</h3>
                 <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <th>#</th> <th>Date</th> <th>Principal(UGX)</th> <th>Rate(%)</th> <th>Expected(UGX)</th> <th>Status</th> <th>Details</th>
                        </thead>

                        <tbody>
                            @foreach($account->loan as $loans)
                             <tr>
                                 <td>{{$loans->id}}</td>
                                 <td>{{$loans->created_at}}</td>
                                 <td>{{number_format($loans->principal)}}</td>
                                 <td>{{$loans->rate}}</td>
                                 <td>
                                     {{number_format($loans->principal + ($loans->principal*($loans->rate/100)))}}
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

               <div id="view_payment" class="tab-pane fade">
                <h3>View loan payment</h3>
                  
                 
              </div>

            </div>
        </div>
    </div> 
</div>
@endsection 
@push('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
     <script type="text/javascript">
        var el = document.querySelector('input.number');
        el.addEventListener('keyup', function (event) {
          if (event.which >= 37 && event.which <= 40) return;
          this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
    </script>
@endpush



