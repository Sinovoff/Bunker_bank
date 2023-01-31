'use strict';
var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
var f = new Date();

var qdia = f.getDate();
var qmes = f.getMonth();
var coincide1 = false;
var qano = f.getFullYear();
var coincide2 = true;
var inmes = 0;
var inano = 0;
var marcadia = 0;

//document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());

var CalendarConstructor = function () {
    this.date = new Date();
    this.currentYear = this.date.getFullYear();
    this.currentMonth = this.date.getMonth();
    this.daysShort = ["Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"];
    this.monthNames = [
		"Enero",
		"Febrero",
		"Marzo",
		"Abril",
		"Mayo",
		"Junio",
		"Julio",
		"Agosto",
		"Septiembre",
		"Octubre",
		"Noviembre",
		"Diciembre"
	];

};

CalendarConstructor.prototype.createNewElement = function (element, className) {
    var el = document.createElement(element);
    el.classList.add(className);
    return el;
}

CalendarConstructor.prototype.monthData = function (month, year) {
    var monthData = {
        year: year,
        month: month,
        // Number of days in current month
        monthDaysCount: function () {
            var _this = this;
            var daysCount = new Date(_this.year, _this.month + 1, 0).getDate();
            return daysCount;
        },
        // Get week day for every day in the month 0 to 6.
        weekDay: function (d) {
            var _this = this;
            var dayNum = new Date(_this.year, _this.month, d);
            return dayNum.getDay();
        }
    };

    return monthData;
};

/**
 *	Get the name of the month
 * @param monthNumber Number of the month (0 - 11)
 *	@return String name of the month
 */
CalendarConstructor.prototype.getMonthName = function (monthNumber) {
    for (var i = 0; i < this.monthNames.length; i++) {
        if (i === monthNumber) {
            if (monthNumber == qmes) {
                coincide1 = true;
            } else {
                coincide1 = false;
            }
            return this.monthNames[i];
        }
    }
}

/**
 *	Construct HTML with month name and year
 * @param monthData object
 *	@return HTML with month name and year
 */
CalendarConstructor.prototype.createMonthNameWrap = function (monthData) {
    var div = this.createNewElement("div", "calendar-month-name");
    var span = this.createNewElement("span", "month-name");
    span.innerHTML = "<a onclick='retornar()'><img src='images/flechai.png'></a><b>" + this.getMonthName(monthData.month) + "</b> " + monthData.year + "<a onclick='ejecutar()'><img src='images/flechad.png'></a>";
    div.appendChild(span);
    return div;
}

/**
 *	Construct HTML thead element
 *	@return HTML
 */
CalendarConstructor.prototype.createMonthTableHead = function () {
    var thead = this.createNewElement("thead", "calendar-header");
    var tr = this.createNewElement("tr", "calendar-row");

    for (var i = 0; i < this.daysShort.length; i++) {
        tr.innerHTML += "<th style='color:#888888;'>" + this.daysShort[i] + "</th>";
    }

    thead.appendChild(tr);
    return thead;
}

/**
 *	Distribute month days to the according table cells
 * @param monthData object
 *	@return HTML
 */
CalendarConstructor.prototype.distributeDays = function (monthData, tbody) {
    var day = 0;
    var dayCount = monthData.monthDaysCount() - 1;

    while (day < dayCount + 1) {
        var weekRow = document.createElement("tr");
        for (var i = 0; i < 7; i++) {
            if (monthData.weekDay(day) == i) {
                if (day + 1 == qdia && coincide1 && coincide2 && marcadia == 0) {
                    weekRow.innerHTML += "<td bgcolor='#884444' id ='" + (day + 1) + "' onclick='marcar(this.id)'>" + (day + 1) + "</td>";
                } else if (day + 1 == marcadia) {
                    weekRow.innerHTML += "<td bgcolor='#884444' id ='" + (day + 1) + "' onclick='marcar(this.id)'>" + (day + 1) + "</td>";
                } else {
                    weekRow.innerHTML += "<td id ='" + (day + 1) + "' onclick='marcar(this.id)'>" + (day + 1) + "</td>";
                }
                day++;
            } else {
                weekRow.innerHTML += "<td></td>";
            }
            if (day > dayCount) {
                break;
            }
        }
        tbody.appendChild(weekRow);
    }
}

/**
 *	Construct HTML tbody element
 * @param monthData object
 *	@return HTML
 */
CalendarConstructor.prototype.createMonthTableBody = function (monthData) {
    var tbody = this.createNewElement("tbody", "calendar-body");
    this.distributeDays(monthData, tbody);
    return tbody;
}

/**
 *	Construct HTML table element
 * @param monthData object
 *	@return HTML table element inside wrapper element
 */
CalendarConstructor.prototype.createMonthTableWrap = function (monthData) {
    var div = this.createNewElement("div", "calendar-month");
    var table = this.createNewElement("table", "calendar");
    table.appendChild(this.createMonthTableHead());
    table.appendChild(this.createMonthTableBody(monthData));
    div.appendChild(table);
    return div;
}

/**
 *	Create wrapper element for calendar month
 * @param monthData object
 *	@return HTML element
 */
CalendarConstructor.prototype.createMonthWrapper = function (monthData) {
    var div = this.createNewElement("div", "calendar-wrap");
    div.appendChild(this.createMonthNameWrap(monthData));
    div.appendChild(this.createMonthTableWrap(monthData));
    return div;
}

/**
 *
 *	Update monthData object by incrementing month and year accordingly
 * @param monthData, counter Object with month data, loop counter
 *	@return monthData Updated monthData object
 *
 */
CalendarConstructor.prototype.updateMonthData = function (monthData, counter) {
    if (counter !== 0) {
        if (monthData.month < 11) {
            monthData.month++
        } else {
            monthData.month = 0;
            monthData.year++;
        }
    }
    if (monthData.year == qano) {
        coincide2 = true;
    } else {
        coincide2 = false;
    }
    return monthData;
}

/**
 *	Assigns properties values to render calendar
 * @param data Object containing inital calendar data
 *        id required Element id to contain calendar
 *        month optional Starting month to display (values from 0 to 11)
 *	       year optional Year of the starting month to display (min value 1970)
 *        count Months optional to display (min value of 1)
 */
CalendarConstructor.prototype.parseInputData = function (id, count, month, year) {
    this.startMonth = month > 11 || month === undefined ? this.currentMonth : month;
    this.startMonthsYear = year < 1970 || year === undefined ? this.currentYear : year;
    this.monthCount = count === 0 || count > 3 || count === undefined ? 1 : count;
    this.containerId = id;
}

/**
 *	Render calendar HTML to page
 */
CalendarConstructor.prototype.renderCalendar = function (id, count, month, year) {
    this.parseInputData(id, count, month, year);
    var monthData = this.monthData(this.startMonth, this.startMonthsYear);
    var calendarContainer = document.getElementById(this.containerId);

    for (var i = 0; i < this.monthCount; i++) {
        var updatedData = this.updateMonthData(monthData, i);
        calendarContainer.appendChild(this.createMonthWrapper(updatedData));
    }
}

function empezar() {
        marcadia = vdia;
        if (marcadia != 0) {
            inmes = parseInt(vmes);
            inano = parseInt(vano);
            calendar.renderCalendar("calendar", 1, qmes + inmes, qano + inano);
        } else {
            calendar.renderCalendar("calendar", 1, qmes, qano);
        }
}
var calendar = new CalendarConstructor();
empezar();

function ejecutar() {
    marcadia = 0;
    inmes++;
    if (qmes + inmes > 11) {
        inmes -= 12;
        inano++;
    }
    if (inano != 0) {
        coincide2 = false;
    }
    document.getElementById("calendar").innerHTML = "";
    calendar = new CalendarConstructor();
    calendar.renderCalendar("calendar", 1, qmes + inmes, qano + inano);

}

function retornar() {
    marcadia = 0;
    inmes--;
    if (qmes + inmes < 0) {
        inmes += 12;
        inano--;
    }
    if (inano != 0) {
        coincide2 = false;
    }
    document.getElementById("calendar").innerHTML = "";
    calendar = new CalendarConstructor();
    calendar.renderCalendar("calendar", 1, qmes + inmes, qano + inano);

}

function marcar(clicked_id) {
    var tdElem = document.getElementById(clicked_id);
    marcadia = tdElem.innerText;
    document.getElementById("dia").value = marcadia;
    document.getElementById("mes").value = inmes;
    document.getElementById("ano").value = inano;
    document.getElementById("form1").submit();
}