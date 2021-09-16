@php 
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{(!empty(Auth::user()->image))?url('public/upload/user_images/'.Auth::user()->image):url('public/upload/noimage.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('profiles.view')}}" class="d-block"> {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
               @if(Auth::user()->role=='Admin')
          <li class="nav-item  {{($prefix=='/users')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview  ">
              <li class="nav-item ">
                <a href="{{route('users.view')}}" class="nav-link {{($route=='users.view')?'active':''}}">
                  <i class="fa fa-users nav-icon"></i>
                  <p>View Users</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          <li class="nav-item {{($prefix=='/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('profiles.view')}}" class="nav-link {{($route=='profiles.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Your Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('profiles.password.view')}}" class="nav-link {{($route=='profiles.password.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{($prefix=='/setups')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Setup
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('setups.student.class.view')}}" class="nav-link {{($route=='setups.student.class.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Student Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.student.year.view')}}" class="nav-link {{($route=='setups.student.year.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Year</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.student.group.view')}}" class="nav-link {{($route=='setups.student.group.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Group</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.student.shift.view')}}" class="nav-link {{($route=='setups.student.shift.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Shift</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.fee.category.view')}}" class="nav-link {{($route=='setups.fee.category.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Fee Category</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('setups.fee.amount.view')}}" class="nav-link {{($route=='setups.fee.amount.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Fee Category Amount</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.exam.type.view')}}" class="nav-link {{($route=='setups.exam.type.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Exam Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.subject.view')}}" class="nav-link {{($route=='setups.subject.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Subject View</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.assign.subject.view')}}" class="nav-link {{($route=='setups.assign.subject.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Assign Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('setups.designation.view')}}" class="nav-link {{($route=='setups.designation.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Designation</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{($prefix=='/students')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Studnts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('students.registration.view')}}" class="nav-link {{($route=='students.registration.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Students Registration</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('students.roll.view')}}" class="nav-link {{($route=='students.roll.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Role Generate</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="{{route('students.reg.fee.view')}}" class="nav-link {{($route=='students.reg.fee.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Registration Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.monthly.fee.view')}}" class="nav-link {{($route=='students.monthly.fee.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Monthly Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('students.exam.fee.view')}}" class="nav-link {{($route=='students.exam.fee.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Exam Fee</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{($prefix=='/employee')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Employee
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employee.registration.view')}}" class="nav-link {{($route=='employee.registration.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Employee Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.salary.view')}}" class="nav-link {{($route=='employee.salary.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Employee Salary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.leave.view')}}" class="nav-link {{($route=='employee.leave.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Employee Leave</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('employee.attendence.view')}}" class="nav-link {{($route=='employee.attendence.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Employee Attendence</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{route('employee.monthly.salary.view')}}" class="nav-link {{($route=='employee.monthly.salary.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Employee Monthly Salary</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item {{($prefix=='/marks')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Mark
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('marks.add')}}" class="nav-link {{($route=='marks.add')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Mark Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('marks.edit')}}" class="nav-link {{($route=='marks.edit')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Mark Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('marks.grade.view')}}" class="nav-link {{($route=='marks.grade.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Grade Point</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item {{($prefix=='/accounts')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                 Account Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('accounts.fee.view')}}" class="nav-link {{($route=='accounts.fee.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Student Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('accounts.salary.view')}}" class="nav-link {{($route=='accounts.salary.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Employee Salary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('accounts.cost.view')}}" class="nav-link {{($route=='accounts.cost.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Other Cost</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item {{($prefix=='/report')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                 Report Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('report.profit.view')}}" class="nav-link {{($route=='report.profit.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Monthly Profit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('report.marksheet.view')}}" class="nav-link {{($route=='report.marksheet.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Mark Sheet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('report.result.view')}}" class="nav-link {{($route=='report.result.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Result</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('report.id-card.view')}}" class="nav-link {{($route=='report.id-card.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Student ID Card</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('report.attendence.view')}}" class="nav-link {{($route=='report.attendence.view')?'active':''}}">
                  <i class="far fa-user-circle nav-icon"></i>
                  <p>Attendence Report</p>
                </a>
              </li>

            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>