function KMeans() {
    this.getClusters = function (points, clusterCount) {

        //divide points into equal clusters
        var allClusters = [];
        var allGroups = points.group(clusterCount);

        for (var i = 0; i < allGroups.length; i++) {
            var cluster = new Cluster(allGroups[i]);
            allClusters.push(cluster);
        }

        //start k-means clustering
        var movements = 1;
        while (movements > 0) {

            movements = 0;
            for (var i = 0; i < allClusters.length; i++) //for all clusters
            {
                var cluster = allClusters[i];
                for (var pointIndex = 0; pointIndex < cluster.points.length; pointIndex++) //for all points in each cluster
                {
                    var point = cluster.points[pointIndex];

                    var index = findNearestClusterIndex(allClusters, point);
                    if (index != allClusters.indexOf(cluster)) //if point has moved
                    {
                        cluster.remove(point);
                        allClusters[index].add(point);
                        movements += 1;
                    }
                }
            }
        }

        return allClusters;
    };


    function findNearestClusterIndex(clusters, point) {
        var minimumDistance = Number.MAX_VALUE;
        var nearestClusterIndex = 0;

        for (var k = 0; k < clusters.length; k++) //find nearest cluster
        {
            var distance = point.getDistance(clusters[k].centroid);
            if (distance < minimumDistance) {
                minimumDistance = distance;
                nearestClusterIndex = k;
            }
        }

        return nearestClusterIndex;
    }
}