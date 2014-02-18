'use strict';

angular.module('ufApp')
  .controller('ProjectsTimelineCtrl', ['$scope', 'getter', function ($scope, getter) {
    // Add an event listener.
    $scope.$on('dataLoaded', function(event, page) {
      $scope.page = page;
    });

    // Set config var.
    var config = {
      'id': 'projects',
      'url': '/api/projects-timeline.jsonp?callback=JSON_CALLBACK',
      'parser': function(data) {
        // Set up page data.
        var page = {};
        page.projects = data;

        // Prepare final Gantt projects output
        var gantt = Array();

        // Set up temporary variables
        var proj;
        var task;
        var index;

        for (index = 0; index < page.projects.length; index++) {
          proj = new Object();
          task = new Object();
          // The project needs to be allocated in its own row along with a task showing its timeframe within the row
          proj.id = 'p-' + page.projects[index].nid;
          proj.description = page.projects[index].title;
          task.id = 't-' + page.projects[index].nid;
          task.subject = page.projects[index].title;
          task.from = new Date(page.projects[index].projectStartDate);
          task.to = new Date(page.projects[index].projectEndDate);
          proj.tasks = Array(task);
          // Add the final project Object to the gantt output
          gantt[index] = proj;
        }

        // Assign the gantt output to the page var
        page.gantt = gantt;

        // Then return it.
        return page;
      }
    };
    // Get data, and fire event when ready.
    getter.getData($scope, config);
  }]);
