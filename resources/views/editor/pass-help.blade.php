@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')


@section('dashContent')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Help Is Here
        </h1>
        <ol class="breadcrumb">
                <li>
                    <a href="{{ url('dashboard') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li class="active">
                    <a href="{{ url('passes/analytics') }}">
                        <i class="fa fa-question-circle"></i> FAQ
                    </a>
                </li>
            </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> How do I make a pass?</h3>
            </div>
            <div class="panel-body">
                It's super simple to make content to work with Wavvve. Simply tap or click on the Manage Passes tab in the menu area. Below that will be <a href="{{ url('/passes/editor') }}">"Create Pass"</a> for you to click on. From there you will be asked whether you want a pass with a background image or one with just a small strip of the pass dedicated to a background. We recommend using an image that is expressive and attractive to visitors. You can upload from just about any source. After uploading, you can crop your image right there to size it appropriately. Then, simply input the relevant information into the fields and click "Save Pass."
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> Why can't iPhone users scan my barcode?</h3>
            </div>
            <div class="panel-body">
                The most likely cause is your content isn't activated. You must have you passes set to "True" in the active column of you Passes Manager. You can activate your content by clicking on the text that says either "True" or "False" on the  <a href="{{ url('/passes/manage') }}">"Manage Passes"</a> page. Your pass in someone's iPhone Wallet app will be updated with your latest content any time you activate your new content, so please be aware that they'll be notified each time you activate something new.
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> Why can't I see the proximity notification?</h3>
            </div>
            <div class="panel-body">
                Your beacon hardware only pulls active content. That means any time you create new content it won't be broadcasted by the beacon until you set it to active. We have it set in this way so you don't have to worry about unfinished content being broadcast to the world to see. So if you have a Tuesday ad that you created for next week, but it's not Tuesday, you don't have to worry about people seeing it. To resolve this the most likely cause is your content isn't activated. You must have you passes set to "True" in the active column of you Passes Manager. You can activate your content by clicking on the text that says either "True" or "False" on the  <a href="{{ url('/passes/manage') }}">"View Passes"</a> page.
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> Why are iOS Passes different than Android/Google Passes?</h3>
            </div>
            <div class="panel-body">
                Apple tightly regulates content on their devices. As a result, we have to use their format for passes. This has its advantages and disadvantages: mainly, we're fortunate that we have the ability to push a notification to a phone directly even once they leave the area yet they have to allow us access to their phone's Wallet app first to do so. With Android/Google, the user will see the pass without any additional requirements yet you're limited by current technologies. In the future we'll be working to expand capabilities of all platforms, so please feel free to let us know if you would like to see any other features added soon. 
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> How do I delete a pass?</h3>
            </div>
            <div class="panel-body">
                It's super simple to delete content with Wavvve's editor console. Simply tap or click on the Manage Passes tab in the menu area. Below that will be <a href="{{ url('/passes/manage') }}">"View Passes"</a> wher you can click on the  <i class="fa fa-trash fa-fw"></i> button to the right of the pass to delete it from your list. Note that you will delete all content associated with the pass such as visitors to that content. We recommend setting your pass to inactive instead so you don't lose the visitor data.
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> How do I update a pass?</h3>
            </div>
            <div class="panel-body">
                It's super simple to update content with Wavvve's editor console. Simply tap or click on the Manage Passes tab in the menu area. Below that will be <a href="{{ url('/passes/manage') }}">'View Passes'</a> wher you can click on the <i class="fa fa-pencil fa-fw"></i> button to the right of the pass to update its content.
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> How do notification get to users?</h3>
            </div>
            <div class="panel-body">
                Alerts will appear differently based on the operating system of the device. Android Alerts will appear on the "Notifications" drop down menu once in proximity of beacon. iOS users need to opt in either by visiting a site (which we would provide via a visual ad) or the user can scan a bar-code in their wallet app (recommended). Also, if iOS users have Google Chrome and location services enabled, they will also receive the beacon notification. Notifications will appear on the lock screen once they are in proximity of the beacon.
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> How many times will visitors be notified?</h3>
            </div>
            <div class="panel-body">
                Users will be able to see a vendor’s specific deal(s) once they are in proximity of the beacon. This is typically within 150 feet depending on the location and physical obstructions. For Android, the special will always appear in their notifications until they open it. On iOS, once a user opts in to a vendor's specials, they will be notified every time the vendor updates their special. Users will also be notified each time they are in proximity of a business that they have opted in to.
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-question fa-fw"></i> Is it safe to use?</h3>
            </div>
            <div class="panel-body">
                Absolutely. Our hardware just sends it to phones via ultra low-power Bluetooth. For concerned customers, having Bluetooth on consumes less than 2% of battery in most cases. We don't scrape any personal data from visitors either. Anything of real security concerns are handled directly through Apple and Google. All you have to do is create content.
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection