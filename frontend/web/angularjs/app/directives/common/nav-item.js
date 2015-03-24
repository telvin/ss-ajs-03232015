app.directive('navItem', ['$location', function($location){
    return {
        restrict: 'A',
        link: function(scope, elem, attrs){
            scope.$watch(function() {
                return $location.path();
            }, function(route){
                elem.removeClass(attrs['navItemClass']);
                var rootRoute = route.match(/\/[a-z0-9A-Z]+\//);
                if(rootRoute)
                    route = rootRoute[0].substring(0, rootRoute[0].length - 1);


                if(route === attrs['navItemRoute']){

                    switch(attrs['navActiveTo']){
                        case 'parent':
                        elem.parent().addClass(attrs['navItemClass']); break;
                        case 'children':
                            elem.children().addClass(attrs['navItemClass']); break;
                        case 'self':
                            elem.addClass(attrs['navItemClass']); break;
                        default:
                    }
                }
            });
        }
    }
}]);