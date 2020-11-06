@extends('admin.layouts.admin_master')

@section('title')
Pending Forms
@endsection

@section('header')
    <link rel="stylesheet" href="/css/leave_form.css">   
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pending Forms
                    <a href="{{url('pending')}}" class="btn btn-primary float-right py-2">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <!DOCTYPE html>
                <html>

                <head>
                    <title>
                        Leave Form
                    </title>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <script src="https://kit.fontawesome.com/10155896e6.js"></script>
                    <link href="https://fonts.googleapis.com/css?family=Roboto:&display=swap" rel="stylesheet">
                    <link rel="stylesheet" href="/assets/css/form.css">
                    <link rel="icon" type="image/x-icon" sizes="32x32" href="favicon.png">
                </head>

                <body>


                    <main class="container ">
                        <form class="form-container" method="POST"
                            action="{{ url('pending_update/'.$pending_edit->id) }}">
                            @csrf
                            @method('PUT')
                            <header>

                                <div id="grid">
                                    <div id="address">
                                        <img src="/img/logo.jpg" style="height: 80px; width: 80px" class="mt-2">
                                        <p><span class="bold">Headquarters</span><br>
                                            BUA Towers<br>PC 32, Churchgate Street
                                            P.O Box 70106 Victoria Island, Lagos,Nigeria<br>
                                            <span class="bold">T. </span>+234 1 461 0669 <span class="bold">E.
                                            </span>info@buagroup.com
                                        </p>
                                    </div>
                                    <div id="leave">
                                        <h3><span class="bold">LEAVE REQUEST FORM</span></h3>
                                        <hr>
                                        <p>RC 110076</p>
                                    </div>
                                    <div id="instr">
                                        <p><span class="italic bold">VERY IMPORTANT</span></p>
                                        <p class="italic">1. Staff are expected to give a<span class="bold"> NOTICE OF
                                                ONE WEEK </span>before commencement of annual leave</p>
                                        <p class="italic">2. Staff should not proceed on leave<span class="bold">
                                                UNTIL</span>they have received Approval Coupon from HR Department</p>
                                    </div>
                                    <div id="date">
                                        <input type="date" name="date" value="{{$pending_edit->date}}">
                                    </div>
                                </div>
                            </header>

                            <section id="credentials">
                                <p><span class="bold">SECTION 1 </span>(TO BE COMPLETED BY STAFF) </p>


                                <br>
                                <ul>
                                    <li>
                                        <div class="form-group c1">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" value="{{$pending_edit->name}}">
                                        </div>

                                        <div class="form-group c2">
                                            <label for="name">SAP No.</label>
                                            <input type="text" name="sapno" id="sapno" value="{{$pending_edit->sapno}}">
                                        </div>

                                        <div class="form-group c3">
                                            <label for="cadre">Cadre/Designation</label>
                                            <input type="text" name="cadre" id="cadre" value="{{$pending_edit->cadre}}">
                                        </div>

                                        <div class="form-group c4">
                                            <label for="department">Department</label>
                                            <input type="text" name="department" id="department"
                                                value="{{$pending_edit->department}}">
                                        </div>

                                        <div class="form-group c5">
                                            <label for="shift">shift</label>
                                            <select id="shift" name="shift">
                                                <option value="{{$pending_edit->shift}}">{{$pending_edit->shift}}
                                                </option>
                                                <option value="morning">Morning</option>
                                                <option value="afternoon">Afternoon</option>
                                                <option value="night">Night</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </section>

                            <section id="Leavetype">
                                <p>Type of Leave <span class="italic">(Please select as applicable)</span></p>
                                <ul>
                                    <li>

                                        <select id="leavetype" name="leavetype">
                                            <option value="{{$pending_edit->leavetype}}">{{$pending_edit->leavetype}}
                                            </option>
                                            <option value="annual">Annual Leave</option>
                                            <option value="maternity">Maternity</option>
                                            <option value="casual">Casual Leave</option>
                                            <option value="compassionate">Compassionate Leave</option>
                                            <option value="department">Examination Leave</option>
                                        </select>


                                    </li>
                                </ul>
                                <br>
                                <p>If Casual Leave, please specify purpose</p><input type="text" name="reason"
                                    id="reason" value="{{$pending_edit->reason}}">


                                <ul class="leavedetails">
                                    <li>

                                        <label for="leaveyear">Leave Year</label>
                                        <input type="number" name="leaveyear" id="leaveyear" input style="width:70px"
                                            value="{{$pending_edit->leaveyear}}">



                                        <label for="entitledleave">Annual Leave Days entitled</label>
                                        <input type="number" name="entitledleave" id="entitledleave" input
                                            style="width:70px" value="{{$pending_edit->entitledleave}}">




                                        <label for="daystaken">No. of Days already taken</label>
                                        <input type="number" name="daystaken" id="daystaken" input style="width:70px"
                                            value="{{$pending_edit->daystaken}}">




                                        <label for="totdaysvac">Total Days this Vacation</label>
                                        <input type="number" name="totdaysvac" id="totdaysvac" input style="width:70px"
                                            value="{{$pending_edit->totdaysvac}}">


                                    </li>
                                </ul>

                                <div class="Holidays">
                                    <div class="outstand">
                                        <p>Outstanding No. of Days after this Vacation</p>
                                        <input type="number" name="outstanding" id="outstanding" input
                                            style="width:70px" value="{{$pending_edit->outstanding}}">

                                    </div>
                                    <p>Public Holidays included(Give dates)</p>
                                    <input type="text" name="publicholidays" id="publicholidays"
                                        value="{{$pending_edit->publicholidays}}">
                                </div>



                                <div id="startleave">
                                    <div>
                                        <label for="daystaken">Leave Commences</label>
                                        <input type="date" name="lcommences" id="lcommences"
                                            value="{{$pending_edit->lcommences}}">
                                    </div>

                                    <div>
                                        <label for="daystaken">Leave Ends</label>
                                        <input type="date" name="lends" id="lends" value="{{$pending_edit->lends}}">
                                    </div><br>

                                    <div>
                                        <label for="daystaken">Resumption Date</label>
                                        <input type="date" name="rdate" id="rdate" value="{{$pending_edit->rdate}}">
                                    </div>
                                </div>


                                <div id="contact">
                                    <p>Contact Address<span class="little"> (while on leave)</span><input type="text"
                                            name="contact_add" id="contact_add" value="{{$pending_edit->contact_add}}">

                                    </p>
                                    <p>Contact Phone No.<input type="text" name="phone" id="phone"
                                            value="{{$pending_edit->phone}}"></p>

                                    <P class=>Contact E-mail </P><input type="email" name="email" id="email" input
                                        style="width:500px" value="{{$pending_edit->email}}">
                                </div>
                            </section>
                            <hr class="sectionend">

                            <section id="declaration">
                                <p><span class="bold">SECTION 2- DECLARATION</span></p>
                                <div class="handover">
                                    <p>I will do / I have already done my handover note to</p>
                                    <input type="text" name="decl" id="decl" value="{{$pending_edit->decl}}">
                                </div>
                                <p><span class="bold italic">Reliever to acknowledge receipt of handover note and accept
                                        to cover for the staff proceeding on leave</span></p><br>
                                <div class="dateover">
                                    <input type="text" name=" decl_sig" id="decl_sig"
                                        value="{{$pending_edit->decl_sig}}">

                                    <p>Date<input type="date" name="decl_date" id="decl_date"
                                            value="{{$pending_edit->date}}"></p>
                                </div>

                                <p><span class="italic">Applicant's Signature</span></p>
                                <hr>

                            </section>

                            <section id="section-4">
                                <p><span class="bold">SECTION 3 - Approval</span></p>
                                <p>I confirm that the applicant can proceed on his/her leave as stated and is entitled
                                    to be paid/ has already been paid leave allowance.</p>
                                <div id="signature">
                                    <div>
                                        <input type="text" name="super_sig" id="super_sig"
                                            value="{{$pending_edit->super_sig}}">
                                        <p><span class="italic">Supervisor's Signature</span></p>
                                        <p> <label>Date</label><br>
                                            <input type="date" name=" super_date" id="super_date"
                                                value="{{$pending_edit->super_date}}"></p>
                                    </div>
                                    <div>
                                        <input type="text" name=" hod_sig" id="hod_sig"
                                            value="{{$pending_edit->hod_sig}}">
                                        <p><span class="italic">HOD/Subsidiary's Signature</span></p>
                                        <p> <label>Date</label><br>
                                            <input type="date" name=" hod_date" id="hod_date"
                                                value="{{$pending_edit->hod_date}}"></p>
                                    </div>
                                    <div>
                                        <input type="text" name=" hr_sig" id="hr_sig" value="{{$pending_edit->hr_sig}}">
                                        <p><span class="italic">Head, HR Signature</span></p>
                                        <p> <label>Date</label><br>
                                            <input type="date" name=" hr_date" id="hr_date"
                                                value="{{$pending_edit->hr_date}}"></p>
                                    </div><br>
                                </div>

                                <div class="form-group">
                                    <label>STATUS</label>
                                    <select name="status" class="form-control">
                                        <option value=""></option>
                                        <option value="approved">APPROVED</option>
                                        {{--<option value="pending">PENDING</option>--}}
                                    </select>
                                </div>


                            </section>

                            <section>
                                <p class="italic bold main-footer">NOTE: Staff who have requested for any form of leave
                                    must receive an Approved Memo (Section A) duly signed by Head of Human Resources,
                                    before proceeding on leave. On resumption of duty. Section B of the attached should
                                    duly completed by the staff and forwarded to the Human Resources Department </p>
                            </section>
                            <br>
                            <br>

                            <div class="col-md-12 mb-4">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>

                        </form>
                    </main>



                </body>

                </html>

            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

@endsection