function Cluster(points) {
    var self = this;
    this.points = points || [];

    this.add = function (obj) {
        var arr = obj;
        if (obj instanceof Point)
            arr = [obj];

        for (var i = 0; i < arr.length; i++)
            this.points.push(arr[i]);

        updateCentroid();
    }

    this.remove = function (point) {
        this.points.remove(point);
        updateCentroid();
    }


    this.getPointNearestToCentroid = function () {
        if (!this.points.length)
            return null;

        var minimumDistance = Number.MAX_VALUE;
        var nearestPoint = null;

        for (var i = 0; i < this.points.length; i++) {
            var p = this.points[i];
            var distance = p.getDistance(this.centroid);

            if (distance < minimumDistance) {
                minimumDistance = distance;
                nearestPoint = p;
            }

        }
        return nearestPoint;
    }

    function updateCentroid() {
        if (!self.points.length) {
            self.centroid = new Point(0, 0);
            return;
        }

        var xSum = 0, ySum = 0;

        for (var i = 0; i < self.points.length; i++) {
            xSum += self.points[i].x;
            ySum += self.points[i].y;
        }
        self.centroid = new Point(xSum / self.points.length, ySum / self.points.length);
    }

    updateCentroid();
}
