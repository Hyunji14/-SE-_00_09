function cashGo()
{
	var form = document.getElementsByName('result');
	var hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'how');

	var how = document.getElementsByName('how');
        hiddenF.setAttribute('value', how[0].value);
        form[0].appendChild(hiddenF);

	form[0].submit();
}

function book(max)
{
	var obj = document.getElementsByName('seat');
	var checked_cnt = 0;
	var checked_value = '';
	var arr = new Array();
	for( i=0; i<obj.length; i++ ) {
		if(obj[i].checked) {
			checked_cnt = checked_cnt+1;
			checked_value = obj[i].value;
			arr[checked_cnt-1] = checked_value.split('/')[0];
		}
	}
	if( checked_cnt > max )
	{
		alert('인원이 초과했습니다.');
	}
	else if( checked_cnt < max )
	{
		alert('선택하지 않은 좌석이 있습니다.');
	}
	else if( checked_cnt == max )
	{
		var form = document.getElementsByName('seatform');
		form[0].setAttribute('action', 'book_action.php');
		var hiddenF = document.createElement('input');
		hiddenF.setAttribute('type', 'hidden');
		hiddenF.setAttribute('name', 'seats');
		hiddenF.setAttribute('value', arr);
		form[0].appendChild(hiddenF);
		form[0].submit();
	}
}

function bt(id)
{
	var prev_bt = document.getElementsByClassName('button_select');
	var selected_id = document.getElementById(id);
	prev_bt[0].className='button effect';
	selected_id.className='button_select';

	menu = document.getElementById("s_bt1_m").setAttribute("style", "visibility: hidden;");
	menu = document.getElementById("s_bt2_m").setAttribute("style", "visibility: hidden;");

	menu = document.getElementById("s_"+id+"_m");
	menu.setAttribute("style", "visibility: visible;");
	if( id == 'bt1' ) cur = 'A';
	else if( id == 'bt2' ) cur = 'B';
	else cur = 'C';
}

function next()
{
	var ck = valid();
	if( ck == 5 )
	{
		setPost();
	}
	else if( ck == 0 ) alert('출발지 확인');
	else if( ck == 1 ) alert('도착지 확인');
	else if( ck == 2 ) alert('날짜 확인');
	else if( ck == 3 ) alert('시간 확인');
	else if( ck == 4 ) alert('매표수 확인');
}

var start;
var end;
var date;
var time;
var senior;
var student;
var junior;
var role;

function valid()
{
	start = document.getElementsByName('start');
	end = document.getElementsByName('end');
	date = document.getElementsByName('date');
	time = document.getElementsByName('time');
	senior = document.getElementsByName('senior');
	student = document.getElementsByName('student');
	junior = document.getElementsByName('junior');
	role = document.getElementsByName('role');

	var result = 0;

	if( start[0].value == 0 ) result = 0;
	else if( end[0].value == 0 ) result = 1;
	else if( date[0].value == 0 ) result = 2;
	else if( time[0].value == 0 ) result = 3;
	else if( senior[0].value == 0 && student[0].value == 0 && junior[0].value == 0 ) result = 4;
	else result = 5;
	return result;
}

function setPost()
{
	var form = document.createElement('form');
	form.setAttribute('method', 'post');
	form.setAttribute('action', './book.php');

	var hiddenF = document.createElement('input');
	hiddenF.setAttribute('type', 'hidden');
	hiddenF.setAttribute('name', 'start');
	hiddenF.setAttribute('value', start[0].value);
	form.appendChild(hiddenF);

	hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'end');
        hiddenF.setAttribute('value', end[0].value);
        form.appendChild(hiddenF);

	hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'date');
        hiddenF.setAttribute('value', date[0].value);
        form.appendChild(hiddenF);

	hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'time');
        hiddenF.setAttribute('value', time[0].value);
        form.appendChild(hiddenF);

	hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'role');
        hiddenF.setAttribute('value', role[0].value);
        form.appendChild(hiddenF);
	
	hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'senior');
        hiddenF.setAttribute('value', senior[0].value);
        form.appendChild(hiddenF);

	hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'student');
        hiddenF.setAttribute('value', student[0].value);
        form.appendChild(hiddenF);
	hiddenF = document.createElement('input');
        hiddenF.setAttribute('type', 'hidden');
        hiddenF.setAttribute('name', 'junior');
        hiddenF.setAttribute('value', junior[0].value);
        form.appendChild(hiddenF);

	form.submit();
}



