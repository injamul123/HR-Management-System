<?php
require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';


$sql = "SELECT * FROM employee";
$res = $db->query($sql);
$employees = [];
while($row = $res->fetch_object()){
  $employees[] = $row;
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<a href="#"><strong><span class="fa fa-dashboard"></span> Pay Calculation</strong></a>
	<hr>
	<div id="msg"></div>
	<div class="card">
		<div class="card-header">
			<i class="fas fa-calculator"></i>
			Calculate Pay
		</div>
		<div class="card-body">
			<form id="payForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
				
				<div class="form-row">
					<div class="form-group col-lg-3">
						<label for="name">Employee Name</label>
						<input type="hidden" name="emp-full-name" id="cal-emp-full-name">
						<select class="form-control form-control-sm" name="emp-name" id="cal-emp-name">
							<option value="none">--Select Employee Name--</option>
							<?php foreach($employees as $e): ?>
							<option value="<?php echo $e->id?>"><?php echo $e->name ?></option>
							<?php endforeach ?>
						</select>
						<small id="empname-error" class="form-text text-danger"></small>
					</div>
					<div class="form-group col-lg-3">
						<label for="name">Department</label>
						<input type="text"  class="form-control form-control-sm" id="cal-department" name="department" placeholder="department">
						<small id="desig-error" class="form-text text-danger"></small>
					</div>
				</div>
				<div class="form-group col-lg-3">
					<label for="name">Year</label>
					<select type="text" class="form-control form-control-sm" id="cal-year" name="year">
						<option value="none">--Select Year--</option>
						<?php
						$d = new DateTime('Asia/Kolkata');
						$currYear = $d->format('Y');
						?>
						<?php for ($i = 10; $i > 0; $i--): ?>
						<option <?=$currYear == $currYear - $i + 1 ? 'selected' : null?> value="<?=$currYear - $i + 1?>"><?=$currYear - $i + 1?></option>
						<?php endfor?>
					</select>
					<small id="year-error" class="form-text text-danger"></small>
				</div>
				<div class="form-group col-lg-3">
					<label for="name">Month</label>
					<select class="form-control form-control-sm" id="cal-month" name="month">
						<option value="none">--Select Month--</option>
						<?php
						$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
						$currMonth = $d->format('F');
						?>
						<?php foreach ($months as $m): ?>
						<option value="<?=$m?>"><?=$m?></option>
						<?php endforeach?>
					</select>
					<small id="month-error" class="form-text text-danger"></small>
				</div>
						<hr>
					<h6>Employee Salary</h6>
				<div class="form-row">
						<div class="form-group col-lg-3">
							<label for="name">Basic Pay</label>
							<input type="text" class="form-control form-control-sm" id="cal-basic-pay" name="basic-pay" placeholder="Basic Pay">
							<small id="basicpay-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">TDS</label>
							<input type="text" class="form-control form-control-sm" id="cal-tds" name="tds" placeholder="TDS">
							<small id="tds-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">Loan</label>
							<input type="text" class="form-control form-control-sm" id="cal-loan" name="loan" placeholder="Loan">
							<small id="loan-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">Salary Advance</label>
							<input type="text" class="form-control form-control-sm" id="cal-sal-avd" name="sal-avd" placeholder="Salary Advance">
							<small id="sal-adv-error" class="form-text text-danger"></small>
						</div>
					</div>

					<div class="form-row">

						<div class="form-group col-lg-3">
							<label for="name">Canteen</label>
							<input type="text" class="form-control form-control-sm" id="cal-canteen" name="canteen" placeholder="Canteen">
							<small id="canteen-error" class="form-text text-danger"></small>
						</div>
						<div class="form-group col-lg-3">
							<label for="name">LIC</label>
							<input type="text" class="form-control form-control-sm" id="cal-lic" name="lic" placeholder="LIC">
							<small id="lic-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">Working Days</label>
							<input type="text" class="form-control form-control-sm" id="cal-wd" name="working-days" placeholder="Working Days">
							<small id="work-days-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">PF</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-pf" name="pf" placeholder="PF">
							<small id="pf-error" class="form-text text-danger"></small>
						</div>
					</div>
					<div class="form-row">

						<div class="form-group col-lg-3">
							<label for="name">DA</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-da" name="da" placeholder="DA">
							<small id="da-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">MA</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-ma" value="150" name="ma" placeholder="MA">
							<small id="ma-error" class="form-text text-danger"></small>
						</div>
						<div class="form-group col-lg-3">
							<label for="name">CA</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-ca" value="60" name="ca" placeholder="CA">
							<small id="ca-error" class="form-text text-danger"></small>
						</div>
						<div class="form-group col-lg-3">
							<label for="name">PTAX</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-ptax" name="ptax" placeholder="PTAX">
							<small id="ptax-error" class="form-text text-danger"></small>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-lg-3">
							<label for="name">HRA</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-hra" name="hra" placeholder="HRA">
							<small id="hra-error" class="form-text text-danger"></small>
						</div>
						<div class="form-group col-lg-3">
							<label for="name">ESI</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-esi" name="esi" placeholder="ESI">
							<small id="esi-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">Total Pay</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-total-pay" name="total-pay" placeholder="Total Pay">
							<small id="totalpay-error" class="form-text text-danger"></small>
						</div>

						<div class="form-group col-lg-3">
							<label for="name">Gross Pay</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-gross-pay" name="gross-pay" placeholder="Gross Pay">
							<small id="grosspay-error" class="form-text text-danger"></small>
						</div>
					</div>
						<div class="form-row">
						<div class="form-group col-lg-3">
							<label for="name">Net Pay</label>
							<input type="text" readonly class="form-control form-control-sm" id="cal-net-pay" name="net-pay" placeholder="Net Pay">
							<small id="netpay-error" class="form-text text-danger"></small>
						</div>
					</div>

					<div class="form-row text-right">
						<div class="form-group col-lg-3">
						
							<button type="button" id="calculate" class="btn btn-success">Calculate</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>


			</form>
		</div>
	</div>



	<script>
const HOST = "http://localhost:4000";
const employeeName = document.querySelector("#cal-emp-name");
const empDept = document.querySelector("#cal-department");
const empId = document.querySelector("#cal-emp-no");
const basicPay = document.querySelector("#cal-basic-pay");


const month = document.querySelector("#cal-month");
const year = document.querySelector("#cal-year");

const tds = document.querySelector("#cal-tds");

const loan = document.querySelector("#cal-loan");
const salAvd = document.querySelector("#cal-sal-avd");
const canteen = document.querySelector("#cal-canteen");
const lic = document.querySelector("#cal-lic");
const workingDays = document.querySelector("#cal-wd");


const pf = document.querySelector("#cal-pf");
const da = document.querySelector("#cal-da");
const ma = document.querySelector("#cal-ma");
const ca = document.querySelector("#cal-ca");
const ptax = document.querySelector("#cal-ptax");
const hra = document.querySelector("#cal-hra");
const esi = document.querySelector("#cal-esi");
const totalPay = document.querySelector("#cal-total-pay");
const grossPay = document.querySelector("#cal-gross-pay");
const netPay = document.querySelector("#cal-net-pay");

const basicpayError = document.querySelector("#basicpay-error");
const tdsError = document.querySelector("#tds-error");
const loanError = document.querySelector("#loan-error");
const salAvdError = document.querySelector("#sal-adv-error");
const canteenError = document.querySelector("#canteen-error");
const licError = document.querySelector("#lic-error");
const workdaysError = document.querySelector("#work-days-error");
const monthError = document.querySelector("#month-error");

const btnCalculate = document.querySelector("#calculate");


employeeName.addEventListener("change", function() {
  let value = this.value;
  console.log(value);
 var params = new URLSearchParams();
  params.append('emp_id', value);

  fetch('../api/empDetails.php', {
    method: "POST",
    headers: {
         "Content-Type": "application/x-www-form-urlencoded"
    },
     body: params
  })
    .then(response => {
      return response.json();
    })
    .then(json => {
    	console.log(json.basicPay)
    	/*json.forEach( emp =>{
    		console.log(emp)
    		//empDept.value = emp.department;
    		 basicPay.value = emp.basicPay;

    	});*/
      empDept.value = json.dept_name;
    	basicPay.value = json.basicPay;
      
      //empId.value = json.emp_id;
     
    })
    .catch(error => {
      console.log(error);
    });
});

btnCalculate.addEventListener("click", function() {
  let data = {
    "basicPay": basicPay.value,
    "tds": tds.value,
    "loan": loan.value,
    "salAvd": salAvd.value,
    "canteen": canteen.value,
    "lic": lic.value,
    "workingDays": workingDays.value,
    "month": month.value
  };
  clearErrorMessage();
  msg.innerHTML = "";

  fetch('../api/calculate-pay.php', {
    method: "POST",
    headers: {
		"Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  })
    .then(response => {


		if (response.status == 400) {
        response.json().then(json => {
          displayErrorMessage(response);
        });
      }
		//response.text;
      return response.json();
    })
    .then(json => {
      console.log(json);
      pf.value = json.pf;
      da.value = json.da;
      //ma.value = json.MA;
      //ca.value = json.CA;
      ptax.value = json.ptax;
      hra.value = json.hra;
      esi.value = json.esi;
      totalPay.value = json.totalPay;
      grossPay.value = json.grossPay;
      netPay.value = json.netPay;
    })
    .catch(error => {
      console.log(error);
    });
});
//save salary
const payFrom = document.querySelector("#payForm");
const msg = document.querySelector("#msg");

payFrom.addEventListener("submit", function(event) {
  event.preventDefault();
  let plainData = new FormData(this);
  const data = new URLSearchParams(plainData);
  msg.innerHTML = "";
  fetch('../api/save-salary.php', {
    method: "POST",
	headers: {
		"Content-Type": "application/x-www-form-urlencoded"
    },
    body: data
  })
    .then(response => {
		console.log(response);
      if (response.status == 200) {
        response.json().then(json => {
          msg.innerHTML =
            '<div class="alert alert-success"><strong><i class="fas fa-check"></i> Success! </strong>' +
            json.msg +
            "</div>";
        });
      } else {
        res.json().then(json => {
          msg.innerHTML =
            '<div class="alert alert-danger"><strong><i class="fas fa-times"></i> Failed! </strong>' +
            json.msg +
            "</div>";
        });
      }
    })
    .catch(error => {
      console.error(error);
    });
});


function displayErrorMessage(json) {
	console.log(json)
  basicpayError.innerHTML = json.basicPay;
  tdsError.innerHTML = json.tds;
  loanError.innerHTML = json.loan;
  salAvdError.innerHTML = json.salAdv;
  canteenError.innerHTML = json.canteen;
  licError.innerHTML = json.lic;
  workdaysError.innerHTML = json.workingdays;
  monthError.innerHTML = json.month;
}

function clearErrorMessage() {
  basicpayError.innerHTML = "";
  tdsError.innerHTML = "";
  loanError.innerHTML = "";
  salAvdError.innerHTML = "";
  canteenError.innerHTML = "";
  licError.innerHTML = "";
  workdaysError.innerHTML = "";
  monthError.innerHTML = "";
}

	</script>