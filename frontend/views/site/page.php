<div ng-controller="RemoteModalCtrl">

    <div ng-if="isShowButtons()">
        <button class="btn btn-default" ng-click="open()">Open me!</button>
<!--        <button class="btn btn-default" ng-click="open('lg')">Large modal</button>-->
<!--        <button class="btn btn-default" ng-click="open('sm')">Small modal</button>-->
        <div ng-show="selected">Selection from a modal: {{ selected }}</div>
     </div>

    <div ng-view="">

    </div>
</div>