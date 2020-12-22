@extends('hod.layouts.hod_master')

@section('title')
Leave form
@endsection

@section('header')
<link rel="icon" type="image/x-icon" sizes="32x32" href="favicon.png">
 <script src="https://kit.fontawesome.com/10155896e6.js"></script>
 <link href="https://fonts.googleapis.com/css?family=Roboto:&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="/css/leave_form.css">
@endsection

@section('content')
<div class="desktop moblie">
    <main class="container">
        <form class="form-container" method="POST" action="hod_submit_leave">
            @csrf
            <header>

                <div id="grid">
                    <div id="address">
                        <img src="/img/logo.jpg" style="height: 90px" >
                        <p><span class="bold">Headquarters</span><br>
                            BUA Towers<br>PC 32, Churchgate Street
                            P.O Box 70106 Victoria Island, Lagos,Nigeria<br>
                            <span class="bold">T. </span>+234 1 461 0669 <span class="bold">E. </span>info@buagroup.com
                        </p>
                    </div><br class="m-hidden"/>
                    <div id="leave">
                        <h3><span class="bold">LEAVE REQUEST FORM</span></h3>
                        <hr>
                        <p>RC 110076</p>
                    </div>
                    <div id="instr">
                        <p><span class="italic bold">VERY IMPORTANT</span></p>
                        <p class="italic">1. Staff are expected to give a<span class="bold"> NOTICE OF ONE WEEK </span>before commencement of annual leave</p>
                        <p class="italic">2. Staff should not proceed on leave<span class="bold"> UNTIL</span>they have received Approval Coupon from HR Department</p>
                    </div><br class="m-hidden"/>
                    <div id="date">
                        <input type="date" class="numValues" name="date" >
                    </div><br class="m-hidden"/><br class="m-hidden"/>
                </div>
            </header>

            <section id="credentials">
                <p><span class="bold">SECTION 1 </span>(TO BE COMPLETED BY STAFF) </p>

                    <div>
                    {{-- <label>Staff ID</label>  <input type="text" value="{{ auth()->user()->StaffID }}" name="StaffID" id="StaffID" readonly>{{ auth()->user()->StaffID }} --}}
                </div>
                <br>
                <ul>
                    <li>
                        <div class="form-group c1">
                            <label for="name">Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" class="maxWidth" name="name" id="name" readonly/>
                        </div>

                        <div class="form-group c2">
                            <label for="name">SAP No.</label>
                            <input type="text" class="numValues maxWidth" name="sapno" id="sapno">
                        </div>

                        <div class="form-group c3">
                            <label for="cadre">Cadre/Designation</label>
                            <input type="text" class="maxWidth" name="cadre" id="cadre">
                        </div>

                        <div class="form-group c4">
                            <label for="department">Department</label>
                        <input type="text" value="{{ auth()->user()->department }}" class="maxWidth"  name="department" id="department" readonly/>
                        </div>

                        <div class="form-group c5">
                            <label for="shift">shift</label>
                            <select id="shift" name="shift">
                                <option value=""></option>
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="night">Night</option>
                            </select>
                        </div>
                    </li>
                </ul>
            </section>

            <section  id="Leavetype">
                <p>Type of Leave <span class="italic">(Please select as applicable)</span></p>
                <ul>
                    <li>

                        <select id="leavetype" name="leavetype" class="leavetype">
                            <option value=""></option>
                            <option value="annual">Annual Leave</option>
                            <option value="maternity">Maternity</option>
                            <option value="casual">Casual Leave</option>
                            <option value="compassionate">Compassionate Leave</option>
                            <option value="department">Examination Leave</option>
                        </select>


                    </li>
                </ul>
                <br>
                <p>If Casual Leave, please specify purpose</p><input type="text" name="reason" id="reason">


                <ul  class="leavedetails">
                    <li>

                        <label for="leaveyear">Leave Year</label>
                        <input type="number" class="numValues" name="leaveyear" id="leaveyear" input style="width:70px">



                        <label for="entitledleave">Annual Leave Days entitled</label>
                        <input type="number" class="numValues" name="entitledleave" id="entitledleave"input style="width:70px"  >




                        <label for="daystaken">No. of Days already taken</label>
                        <input type="number" class="numValues" name="daystaken" id="daystaken"input style="width:70px" >




                        <label for="totdaysvac">Total Days this Vacation</label>
                        <input type="number" class="numValues" name="totdaysvac" id="totdaysvac"input style="width:70px" >


                    </li>
                </ul>

                <div class="Holidays">
                    <div class="outstand">
                        <p>Outstanding No. of Days after this Vacation</p>
                        <input type="number" class="numValues" name="outstanding" id="outstanding" input style="width:70px">

                    </div>
                    <p>Public Holidays included(Give dates)</p>
                    <input type="text" class="numValues maxWidth" name="publicholidays" id="publicholidays">
                </div>



                <div id="startleave"><br class="m-hidden"/>
                    <div>
                        <label for="daystaken">Leave Commences</label> <br class="m-hidden"/>
                        <input type="date" class="numValues" name="lcommences" id="lcommences">
                    </div><br class="m-hidden"/>

                    <div>
                        <label for="daystaken">Leave Ends</label> <br class="m-hidden"/>
                        <input type="date" class="numValues" name="lends" id="lends">
                    </div><br class="m-hidden"/>

                    <div>
                        <label for="daystaken">Resumption Date</label> <br class="m-hidden"/>
                        <input type="date" class="numValues" name="rdate" id="rdate">
                    </div>
                </div><br class="m-hidden"/>


                <div id="contact">
                    <p>Contact Address<span class="little"> (while on leave)</span><input type="text" class="maxWidth numValues" name="contact_add" id="contact_add">

                    </p> <br/>
                    <p>Contact Phone No.<input type="text" class="maxWidth numValues" name="phone" id="phone"></p><br/>

                <P class=>Contact E-mail </P><input type="email" value="{{ auth()->user()->email }}" class="maxWidth numValues" name="email" id="email" readonly/>
                </div>
            </section>
            <hr class="sectionend">

            <section id="declaration">
                <p><span class="bold">SECTION 2- DECLARATION</span></p>
                <div class="handover">
                    <p>I will do / I have already done my handover note to</p>
                    <input type="text" name="decl" id="decl">
                </div>
                <p><span class="bold italic">Reliever to acknowledge receipt of handover note and accept
                            to cover for the staff proceeding on leave</span></p><br>
                <div class="dateover">
                    <div class="form-group">
                        <p><span class="italic" style="margin-right: 30px">Applicant's Confirmation</span></p>
                        <select name="decl_sig" class="form-control">
                            <option value="approved">APPROVED</option>
                            <option value="pending">PENDING</option>
                        </select>

                        <p class="ml-5 mt-md-0 mt-3">Date<input type="date" class="numValues ml-2 ml-md-0" name="decl_date" id="decl_date"></p>
                    </div>
                </div>


                <hr>

                <input type="hidden" value="approved" name="super_sig" id="super_sig" hidden />
                <input type="hidden" value="approved" name=" hod_sig" id="hod_sig" hidden />
                <input type="hidden" value="pending" name=" hr_sig" id="hr_sig" hidden />
            </section>

            {{-- <section id="section-4" style="display: none" >
                <p><span class="bold">SECTION 3 - Approval</span></p>
                <p>I confirm that the applicant can proceed on his/her leave as stated and is entitled to be paid/ has already been paid leave allowance.</p>
                <div id="signature">
                    <div>
                        <input type="text" name="super_sig" id="super_sig">
                        <p><span class="italic">Supervisor's Signature</span></p>
                        <p> <label>Date</label><br>
                            <input type="date" name=" super_date" id="super_date"></p>
                    </div>
                    <div>
                        <input type="text" name=" hod_sig" id="hod_sig">
                        <p><span class="italic">HOD/Subsidiary's Signature</span></p>
                        <p> <label>Date</label><br>
                            <input type="date" name=" hod_date" id="hod_date"></p>
                    </div>
                    <div>
                        <input type="text" name=" hr_sig" id="hr_sig">
                        <p><span class="italic">Head, HR Signature</span></p>
                        <p> <label>Date</label><br>
                            <input type="date" name=" hr_date" id="hr_date"></p>
                    </div><br>
                </div>
            </section> --}}

            <section>
                <p  class="italic bold main-footer">NOTE: Staff who have requested for any form of leave must receive an Approved Memo (Section A) duly signed by Head of Human Resources, before proceeding on leave. On resumption of duty. Section B of the attached should duly completed by the staff and forwarded to the Human Resources Department  </p>
            </section>
            <br>
            <br>

            <button type="submit" class="btn btn-success mb-4 ">SUBMIT</button>     <a href="/hod_dashboard" class="btn btn-danger float-right mb-4">CANCEL</a>

        </form>
    </main>
    </div>
@endsection
