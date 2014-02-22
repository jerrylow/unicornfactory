'use strict';

angular.module('ufApp')
  .controller('UserSkillsCtrl', ['$scope', 'getter', function ($scope, getter) {
    // Add an event listener.
    $scope.$on('dataLoaded', function(event, page) {
      $scope.page = page;
    });

    $scope.$watch('uid', function () {

    // Set config var.
    var config = {
      'id': 'user-skills',
      'url': '/api/uf_edit_user/' + $scope['uid'] + '.jsonp?callback=JSON_CALLBACK',
      'parser': function(data) {
        // Set up page data.
        var page = {};
        page = data;
        
        

        delete page.field_user_skill.und.add_more;
        
        var currentHighest = 0;
        var desiredHighest = 0;
        var workingCurrent = 0;
        var workingDesired = 0;
        var highestCurrentObject = null;
        var highestDesiredObject = null;


// Eventually I want to combine these two for loops to one
//    This one finds the highest current rating
          for (var x in page.field_user_skill.und) {
            
              workingCurrent = page.field_user_skill.und[x].field_user_skill_current_rating.und[0].value - 0;
               if (workingCurrent > currentHighest) {
                currentHighest = workingCurrent;
                highestCurrentObject = page.field_user_skill.und[x];
               }
          }

          $scope.highestCurrentObject = highestCurrentObject;

//    This one finds the highest desired rating

          for (var x in page.field_user_skill.und) {
            
              workingDesired = page.field_user_skill.und[x].field_user_skill_desired_rating.und[0].value - 0;
               if (workingDesired > desiredHighest) {
                desiredHighest = workingDesired;
                highestDesiredObject = page.field_user_skill.und[x];
               }
          }

          $scope.highestDesiredObject = highestDesiredObject;
    
        // console.log(numbersOnly);
        // for (var i = 0; i < numbersOnly.length; i++) {
        //   currentRatings.push(page.field_user_skill.und.numbersOnly[0].field_user_skill_current_rating.und[0].value);
        //   console.log(currentRatings);
        //   desiredRatings.push(page.field_user_skill.i.field_user_skill_desired_rating);
        // }

        // var highestCurrent = Math.max(currentRatings);
        // Then return it.
        return page;

        // return numbersOnly;
      }
    };
    // Get data, and fire event when ready.
    getter.getData($scope, config);
  });
}]);