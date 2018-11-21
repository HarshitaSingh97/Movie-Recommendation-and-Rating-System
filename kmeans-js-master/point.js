/*
function Point(x, y) {
    this.x = x;
    this.y = y;
    this.isBetween = function (p1, p2) {
        return ((this.x >= p1.x && this.x <= p2.x) && (this.y >= p1.y && this.y <= p2.y));
    }

    this.getDistance = function (point) {

        var x1 = this.x, y1 = this.y;
        var x2 = point.x, y2 = point.y;

        //find euclidean distance
        return Math.sqrt(Math.pow(x2 - x1, 2.0) + Math.pow(y2 - y1, 2.0));
    }
}*/

function pointz(x,y,z){
  this.x = x;
  this.y = y;
  this.z = z;
  othis.Point=function(x,y)
  {
    this.x = x;
    this.y = y;


  };
  this.isBetween = function (p1, p2) {
      return ((this.x >= p1.x && this.x <= p2.x) && (this.y >= p1.y && this.y <= p2.y));
  };

  this.getDistance = function (point) {

      var x1 = this.x, y1 = this.y;
      var x2 = point.x, y2 = point.y;

      //find euclidean distance
      return Math.sqrt(Math.pow(x2 - x1, 2.0) + Math.pow(y2 - y1, 2.0));
  }

}
