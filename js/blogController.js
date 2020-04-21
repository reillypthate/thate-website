// JavaScript Document

var app = angular
		.module("blogModule", [])
		.controller("blogController", function ($scope) {
	
			$scope.entries = blogPosts;
			$scope.currentPage = 0;
			$scope.pageSize = 5;
			$scope.numberOfPages = function()
			{
				return Math.ceil($scope.entries.length/$scope.pageSize);
			};
			
			$scope.setPage = function(pageNum)
			{
				$scope.currentPage = pageNum;
			};
});

app.filter('startFrom', function(){
	return function(input, start) {
		start = +start;
		return input.slice(start);
	}
});