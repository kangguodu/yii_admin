var openHourData = JSON.parse(_myOpenHours);  
console.log(openHourData);
console.log(openHourData.open_hours);
if(openHourData.routine_holiday > 0){
	openHourData.routine_holiday_check = true;
}else{
	openHourData.routine_holiday_check = false;
}
if(openHourData.special_holiday != ""){
	openHourData.special_holiday_check = true;
}else{
	openHourData.special_holiday_check = false;
}

if(openHourData.special_business_day != ""){
	openHourData.special_business_day_check = true;
}else{
	openHourData.special_business_day_check = false;
}


openHourData.id = 1;



var myapp = new Vue({
  el: '#myvue-app',
  data: openHourData,
});

Vue.use(window.VueTimepicker);

