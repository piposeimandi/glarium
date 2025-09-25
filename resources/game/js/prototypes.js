import Panzoom from '@panzoom/panzoom'
import moment from 'moment'

/*
String.prototype.capitalize = function (){
    return this.charAt(0).toUpperCase()+this.slice(1);
}
*/

export function sectotime(secs){
  var minutes = Math.floor(secs / 60);
  secs = secs%60;
  var hours = Math.floor(minutes/60)
  minutes = minutes%60;
  var res = '';
  if(hours!=0)
    res+=pad(hours)+'h ';
  if(minutes!=0)
    res+=pad(minutes)+'m ';
  res+=pad(secs)+'s';
  return res;
}

function pad(num) {
    return ("0"+num).slice(-2);
}

export function sum(obj, prop){
    var total = 0
    for ( var i = 0, _len = obj.length; i < _len; i++ ) {
        total += parseInt(obj[i][prop])
    }
    return total
}

export function zoom(){
    const elem = document.getElementById('zoom')
    var panzoom = Panzoom(elem, {
        disablePan:true,
        animate:true,
        step:0.12,
        maxScale: 1,
        minScale: 0.80,
        origin: '0 0',
        setTransform: (elem, { scale, x, y }) => {
            if(panzoom!=undefined){
                panzoom.setStyle('transform', `scale(${scale})`)
            }
        }
    })
    elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel)
}

export function checkHorarioTipo(movement){
    if(checkMoment(movement.start_at)){
        return 1;
    }
    if(checkMoment(movement.end_at)){
        return 2;
    }
    if(checkMoment(movement.return_at)){
        return 3;
    }
}

function checkMoment(time){
    return moment(time) > moment()
}

Number.prototype.money = function(n, x) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
  return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

export function money(number){
  return number==undefined ? 0 : Math.floor(number).money();
}

export function money_two(number){
  return number==undefined ? 0 : parseFloat(number).money(2);
}

export function floor(number){
  return number==undefined ? 0 : Math.floor(number);
}
