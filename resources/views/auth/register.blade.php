@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('register.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <a class="navbar-brand me-2 mb-1 d-flex align-items-center"href="{{route('home.index')}}" style="height: 120px;
        padding: 0px;
        margin-left: 100px;
        margin-top: 10px;
        width: 203px;">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="150" height="150" viewBox="0 0 172 172" style="height: 100px;width: 165px;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><g><path d="M13.4375,2.6875h139.75c2.96853,0 5.375,2.40647 5.375,5.375v102.125v0h-150.5v0v-102.125c0,-2.96853 2.40647,-5.375 5.375,-5.375z" fill="#cccccc"></path><path d="M158.5625,110.1875l8.0625,16.125h-61.8125l-2.6875,-8.0625h-37.625l-2.6875,8.0625h-61.8125l8.0625,-16.125h16.125h2.6875h59.125h64.5z" fill="#cccccc"></path><path d="M104.8125,126.3125h61.8125c0,5.93706 -4.81294,10.75 -10.75,10.75h-145.125c-5.93706,0 -10.75,-4.81294 -10.75,-10.75z" fill="#cccccc"></path><path d="M161.25,131.6875h-137.0625c-2.96853,0 -5.375,-2.40647 -5.375,-5.375h-18.8125c0,5.93706 4.81294,10.75 10.75,10.75h145.125c5.93706,0 10.75,-4.81294 10.75,-10.75c0,2.96853 -2.40647,5.375 -5.375,5.375z" fill="#ffffff"></path><path d="M24.45625,113.56569l1.34375,-3.37819h-17.7375l-8.0625,16.125h61.8125l1.79256,-5.375h-34.16619c-1.7823,-0.00255 -3.44743,-0.88843 -4.4455,-2.36507c-0.99807,-1.47664 -1.19925,-3.352 -0.53713,-5.00674z" fill="#cccccc"></path><path d="M103.01994,120.9375l1.79256,5.375h61.8125l-2.6875,-5.375z" fill="#cccccc"></path><path d="M153.1875,2.6875h-139.75c-2.96853,0 -5.375,2.40647 -5.375,5.375v102.125h150.5v-102.125c0,-2.96853 -2.40647,-5.375 -5.375,-5.375zM155.875,107.5h-145.125v-99.4375c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875h139.75c1.48427,0 2.6875,1.20323 2.6875,2.6875z" fill="#ffffff"></path><path d="M102.125,118.25l2.6875,8.0625h-43l2.6875,-8.0625z" fill="#cccccc"></path><path d="M69.875,118.25h-5.375l-2.6875,8.0625h43l-0.89763,-2.6875c-31.38462,-0.10481 -34.03987,-5.375 -34.03987,-5.375z" fill="#ffffff"></path><path d="M166.625,26.875v10.75h-13.4375v1.34375c0.00574,1.78368 -0.70029,3.49595 -1.96154,4.75721c-1.26126,1.26126 -2.97353,1.96728 -4.75721,1.96154c-3.71066,0 -6.71875,3.00809 -6.71875,6.71875v9.40625h-18.8125v-8.0625h-2.6875c-4.4528,0 -8.0625,-3.6097 -8.0625,-8.0625c0,-4.4528 3.6097,-8.0625 8.0625,-8.0625h10.75c2.95939,-0.02195 5.35305,-2.41561 5.375,-5.375c0.00885,-2.96486 2.41014,-5.36615 5.375,-5.375z" fill="#666666"></path><path d="M150.5,102.125v8.0625c-0.00885,2.96486 -2.41014,5.36615 -5.375,5.375h-32.25c-2.96486,-0.00885 -5.36615,-2.41014 -5.375,-5.375v-48.375h43z" fill="#333333"></path><path d="M161.25,150.5v10.75h-110.1875c-1.48427,0 -2.6875,-1.20323 -2.6875,-2.6875v-5.375c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875z" fill="#cccccc"></path><path d="M161.25,123.625v10.75h-110.1875c-1.48427,0 -2.6875,-1.20323 -2.6875,-2.6875v-5.375c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875z" fill="#cccccc"></path><path d="M166.625,161.25v8.0625h-116.15375c-7.09479,0 -12.84625,-5.75146 -12.84625,-12.84625v-1.1825c0,-7.09479 5.75146,-12.84625 12.84625,-12.84625h116.15375v8.0625h-115.5625c-1.48427,0 -2.6875,1.20323 -2.6875,2.6875v5.375c0,1.48427 1.20323,2.6875 2.6875,2.6875z" fill="#333333"></path><path d="M166.625,134.375v8.0625h-116.15375c-7.09479,0 -12.84625,-5.75146 -12.84625,-12.84625v-1.1825c0,-7.09479 5.75146,-12.84625 12.84625,-12.84625h116.15375v8.0625h-115.5625c-1.48427,0 -2.6875,1.20323 -2.6875,2.6875v5.375c0,1.48427 1.20323,2.6875 2.6875,2.6875z" fill="#34495e"></path><rect x="7" y="6" transform="scale(2.6875,2.6875)" width="10" height="2" rx="1" ry="0" fill="#34495e"></rect><rect x="7" y="10" transform="scale(2.6875,2.6875)" width="20" height="2" fill="#606060"></rect><rect x="7" y="14" transform="scale(2.6875,2.6875)" width="20" height="2" fill="#606060"></rect><path d="M158.5625,104.8125h-8.0625v-5.375h8.0625c1.48427,0 2.6875,-1.20323 2.6875,-2.6875v-21.5c0,-1.48427 -1.20323,-2.6875 -2.6875,-2.6875h-8.0625v-5.375h8.0625c4.4528,0 8.0625,3.6097 8.0625,8.0625v21.5c0,4.4528 -3.6097,8.0625 -8.0625,8.0625z" fill="#e74c3c"></path><path d="M67.34875,58.02313c3.32314,3.04461 5.21488,7.34489 5.21375,11.85188h-16.125v-16.125c4.04797,-0.01406 7.94939,1.51384 10.91125,4.27313z" fill="#e74c3c"></path><path d="M33.67438,71.29938c2.61276,-5.77413 8.36288,-9.48489 14.70063,-9.48687v16.125h16.125c-0.00485,6.58077 -4.00816,12.4983 -10.11472,14.95115c-6.10656,2.45285 -13.09093,0.94881 -17.64663,-3.8001c-4.5557,-4.74891 -5.76851,-11.7897 -3.06428,-17.78917z" fill="#34495e"></path><path d="M64.5,76.59375h-14.78125v-14.78125c0,-0.74213 -0.60162,-1.34375 -1.34375,-1.34375c-6.86385,0.00902 -13.0898,4.02658 -15.92612,10.277c-1.02362,2.25901 -1.54971,4.71165 -1.54263,7.19175c0,9.64772 7.82103,17.46875 17.46875,17.46875c9.64772,0 17.46875,-7.82103 17.46875,-17.46875c0,-0.74213 -0.60162,-1.34375 -1.34375,-1.34375zM48.375,94.0625c-8.90559,0 -16.125,-7.21941 -16.125,-16.125c0,-8.90559 7.21941,-16.125 16.125,-16.125v16.125h16.125c0,8.90559 -7.21941,16.125 -16.125,16.125z" fill="#cccccc"></path><path d="M68.2625,57.03413c-3.21106,-2.98813 -7.4387,-4.64267 -11.825,-4.62788c-0.74213,0 -1.34375,0.60162 -1.34375,1.34375v16.125c0,0.74213 0.60162,1.34375 1.34375,1.34375h16.125c0.74213,0 1.34375,-0.60162 1.34375,-1.34375c-0.00477,-4.88077 -2.05124,-9.53697 -5.64375,-12.84087zM64.5,69.875h-8.0625v-16.125c8.89701,0.02069 16.10431,7.22799 16.125,16.125z" fill="#cccccc"></path><path d="M37.625,76.59375c-0.35663,0.00064 -0.69888,-0.14052 -0.95137,-0.39238l-7.66744,-7.67012h-12.88119c-0.74213,0 -1.34375,-0.60162 -1.34375,-1.34375c0,-0.74213 0.60162,-1.34375 1.34375,-1.34375h13.4375c0.35663,-0.00064 0.69888,0.14052 0.95137,0.39238l8.0625,8.0625c0.38533,0.38435 0.50076,0.96317 0.29236,1.46593c-0.2084,0.50276 -0.69949,0.83017 -1.24373,0.82919z" fill="#606060"></path><path d="M64.5,63.15625c-0.50897,0 -0.97427,-0.28757 -1.20189,-0.74281c-0.22762,-0.45524 -0.1785,-1.00001 0.12689,-1.40719l8.0625,-10.75c0.25377,-0.33836 0.65204,-0.5375 1.075,-0.5375h8.0625c0.74213,0 1.34375,0.60162 1.34375,1.34375c0,0.74213 -0.60162,1.34375 -1.34375,1.34375h-7.39062l-7.65937,10.2125c-0.25377,0.33836 -0.65204,0.5375 -1.075,0.5375z" fill="#606060"></path><path d="M51.0625,123.625h115.5625v-8.0625h-5.375v2.6875c0,1.48427 -1.20323,2.6875 -2.6875,2.6875h-107.5c-2.96853,0 -5.375,2.40647 -5.375,5.375v5.375c0,2.96853 2.40647,5.375 5.375,5.375h107.5c1.48427,0 2.6875,1.20323 2.6875,2.6875v2.6875h5.375v-8.0625h-115.5625c-1.48427,0 -2.6875,-1.20323 -2.6875,-2.6875v-5.375c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875z" fill="#e74c3c"></path><path d="M48.375,126.3125v5.375c0,1.48427 1.20323,2.6875 2.6875,2.6875h5.375c-1.48427,0 -2.6875,-1.20323 -2.6875,-2.6875c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875h104.8125v-5.375h-110.1875c-1.48427,0 -2.6875,1.20323 -2.6875,2.6875z" fill="#cccccc"></path><path d="M51.0625,150.5h115.5625v-8.0625h-5.375v2.6875c0,1.48427 -1.20323,2.6875 -2.6875,2.6875h-107.5c-2.96853,0 -5.375,2.40647 -5.375,5.375v5.375c0,2.96853 2.40647,5.375 5.375,5.375h107.5c1.48427,0 2.6875,1.20323 2.6875,2.6875v2.6875h5.375v-8.0625h-115.5625c-1.48427,0 -2.6875,-1.20323 -2.6875,-2.6875v-5.375c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875z" fill="#34495e"></path><path d="M48.375,153.1875v5.375c0,1.48427 1.20323,2.6875 2.6875,2.6875h5.375c-1.48427,0 -2.6875,-1.20323 -2.6875,-2.6875c0,-1.48427 1.20323,-2.6875 2.6875,-2.6875h104.8125v-5.375h-110.1875c-1.48427,0 -2.6875,1.20323 -2.6875,2.6875z" fill="#cccccc"></path><rect x="53" y="43" transform="scale(2.6875,2.6875)" width="4" height="2" rx="1" ry="0" fill="#34495e"></rect><rect x="29" y="43" transform="scale(2.6875,2.6875)" width="22" height="2" rx="1" ry="0" fill="#34495e"></rect><rect x="53" y="53" transform="scale(2.6875,2.6875)" width="4" height="2" rx="1" ry="0" fill="#333333"></rect><rect x="29" y="53" transform="scale(2.6875,2.6875)" width="22" height="2" rx="1" ry="0" fill="#333333"></rect><path d="M145.125,107.5h-8.0625c-11.87412,0 -21.5,-9.62588 -21.5,-21.5v-24.1875h-8.0625v48.375c0.00885,2.96486 2.41014,5.36615 5.375,5.375h32.25c2.96486,-0.00885 5.36615,-2.41014 5.375,-5.375v-8.0625c0,2.96853 -2.40647,5.375 -5.375,5.375z" fill="#e74c3c"></path><rect x="37" y="23" transform="scale(2.6875,2.6875)" width="3" height="17" fill="#cccccc"></rect><path d="M104.8125,115.5625h8.0625c-2.96486,-0.00885 -5.36615,-2.41014 -5.375,-5.375h-8.0625c0.00885,2.96486 2.41014,5.36615 5.375,5.375z" fill="#cccccc"></path><path d="M50.47125,115.5625h-8.0625c-4.13573,0.00452 -8.01458,2.00651 -10.41406,5.375h8.0625c2.39949,-3.36849 6.27833,-5.37048 10.41406,-5.375z" fill="#cccccc"></path><path d="M37.83731,131.6875c-0.12946,-0.69155 -0.20049,-1.39278 -0.21231,-2.09625v-1.1825c0.01183,-0.70347 0.08285,-1.4047 0.21231,-2.09625h-8.0625c-0.12946,0.69155 -0.20049,1.39278 -0.21231,2.09625v1.1825c0.01183,0.70347 0.08285,1.4047 0.21231,2.09625c0.31563,1.93886 1.07539,3.77846 2.21988,5.375h8.0625c-1.14449,-1.59654 -1.90424,-3.43614 -2.21988,-5.375z" fill="#ffffff"></path><path d="M40.05719,120.9375h-8.0625c-1.14449,1.59654 -1.90424,3.43614 -2.21988,5.375h8.0625c0.31563,-1.93886 1.07539,-3.77846 2.21988,-5.375z" fill="#ffffff"></path><rect x="37" y="40" transform="scale(2.6875,2.6875)" width="3" height="1" fill="#cccccc"></rect><rect x="53" y="25" transform="scale(2.6875,2.6875)" width="2" height="3" rx="1" ry="0" fill="#34495e"></rect><rect x="53" y="29" transform="scale(2.6875,2.6875)" width="2" height="6" rx="1" ry="0" fill="#34495e"></rect></g></g></g></svg>
         </a>
        <h1 class="h3 mb-3 fw-normal text-light">Register</h1>

        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingEmail">Email address</label>
            @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('user_name') }}" placeholder="Username" required="required" autofocus>
            <label for="floatingName">Username</label>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Confirm Password</label>
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <select class="form-control" name="department_id" class="form-control" required>
                @foreach (\App\Models\Department::all() as $department )
                    <option value='{{$department->id}}'>{{$department->dept_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('department_id'))
                <span class="text-danger text-left">{{ $errors->first('department_id') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Studing Year :</label>
            <select class="form-control" name="studing_year" class="form-control" required>
                    <option value='1'>First Year</option>
                    <option value='2'>Secound Year</option>
                    <option value='3'>Third Year</option>
                    <option value='4'>Fourth Year</option>
                    <option value='5'>Fifth Year</option>
            </select>
            @if ($errors->has('studing_year'))
                <span class="text-danger text-left">{{ $errors->first('studing_year') }}</span>
            @endif
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Register</button>
        <a href="{{ route('login.perform') }}" class="w-100 btn btn-lg btn-danger">Go To Login Page</a>
        @include('auth.partials.copy')
    </form>
@endsection
