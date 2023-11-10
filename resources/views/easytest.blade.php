<html>
    <head>

    </head>

    <body>
        <h3>Current Student ID: {{ session('studID') }}</h3>
        <h3>Current Student ID: {{ session('staffID') }}</h3>
        <h3>Current Role: {{ session('role') }}</h3>
        <hr/>
        <h3>Student Side</h3>
        <a href="students/create">Register account</a><br/>
        <a href="students/loginPage">Login</a><br/>
        <a href="/students/logout">Logout</a><br/>

        <hr/>

        <h3>Staff Side</h3>
        <a href="/staffs/staffs/create">Register account</a><br/>
        <a href="staffs/loginPage">Login</a><br/>
        <a href="/staffs/logout">Logout</a><br/>
    </body>
</html>