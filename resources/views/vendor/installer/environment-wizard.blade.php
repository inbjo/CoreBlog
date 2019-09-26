@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-magic fa-fw" aria-hidden="true"></i>
    {!! trans('installer_messages.environment.wizard.title') !!}
@endsection

@section('container')
    <div class="tabs tabs-full">

        <input id="tab1" type="radio" name="tabs" class="tab-input" checked />
        <label for="tab1" class="tab-label">
            <i class="fa fa-cog fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.environment') }}
        </label>

        <input id="tab2" type="radio" name="tabs" class="tab-input" />
        <label for="tab2" class="tab-label">
            <i class="fa fa-database fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.database') }}
        </label>

        <input id="tab3" type="radio" name="tabs" class="tab-input" />
        <label for="tab3" class="tab-label">
            <i class="fa fa-cogs fa-2x fa-fw" aria-hidden="true"></i>
            <br />
            {{ trans('installer_messages.environment.wizard.tabs.application') }}
        </label>

        <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="tabs-wrap">
            <div class="tab" id="tab1content">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                  <label for="app_url">
                    {{ trans('installer_messages.environment.wizard.form.app_url_label') }}
                  </label>
                  <input type="url" name="app_url" id="app_url" value="http://{{$_SERVER['HTTP_HOST']}}" placeholder="{{ trans('installer_messages.environment.wizard.form.app_url_placeholder') }}" />
                  @if ($errors->has('app_url'))
                    <span class="error-block">
                              <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                              {{ $errors->first('app_url') }}
                          </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('name') ? ' has-error ' : '' }}">
                  <label for="name">
                    {{ trans('installer_messages.environment.wizard.form.name_label') }}
                  </label>
                  <input type="text" name="name" id="name" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.name_placeholder') }}" />
                  @if ($errors->has('name'))
                    <span class="error-block">
                              <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                              {{ $errors->first('name') }}
                          </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error ' : '' }}">
                  <label for="email">
                    {{ trans('installer_messages.environment.wizard.form.email_label') }}
                  </label>
                  <input type="text" name="email" id="email" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.email_placeholder') }}" />
                  @if ($errors->has('email'))
                    <span class="error-block">
                              <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                              {{ $errors->first('email') }}
                          </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error ' : '' }}">
                  <label for="password">
                    {{ trans('installer_messages.environment.wizard.form.password_label') }}
                  </label>
                  <input type="text" name="password" id="password" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.password_placeholder') }}" />
                  @if ($errors->has('password'))
                    <span class="error-block">
                              <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                              {{ $errors->first('password') }}
                          </span>
                  @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showDatabaseSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_database') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab2content">

                <input type="hidden" name="database_connection" value="mysql"/>

                <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                    <label for="database_hostname">
                        {{ trans('installer_messages.environment.wizard.form.db_host_label') }}
                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.db_host_placeholder') }}" />
                    @if ($errors->has('database_hostname'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_hostname') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
                    <label for="database_port">
                        {{ trans('installer_messages.environment.wizard.form.db_port_label') }}
                    </label>
                    <input type="number" name="database_port" id="database_port" value="3306" placeholder="{{ trans('installer_messages.environment.wizard.form.db_port_placeholder') }}" />
                    @if ($errors->has('database_port'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_port') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                    <label for="database_name">
                        {{ trans('installer_messages.environment.wizard.form.db_name_label') }}
                    </label>
                    <input type="text" name="database_name" id="database_name" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_name_placeholder') }}" />
                    @if ($errors->has('database_name'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_name') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                    <label for="database_username">
                        {{ trans('installer_messages.environment.wizard.form.db_username_label') }}
                    </label>
                    <input type="text" name="database_username" id="database_username" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_username_placeholder') }}" />
                    @if ($errors->has('database_username'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                    <label for="database_password">
                        {{ trans('installer_messages.environment.wizard.form.db_password_label') }}
                    </label>
                    <input type="text" name="database_password" id="database_password" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.db_password_placeholder') }}" />
                    @if ($errors->has('database_password'))
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('database_password') }}
                        </span>
                    @endif
                </div>

                <div class="buttons">
                    <button class="button" onclick="showApplicationSettings();return false">
                        {{ trans('installer_messages.environment.wizard.form.buttons.setup_application') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="tab" id="tab3content">

                <div class="form-group {{ $errors->has('redis_hostname') ? ' has-error ' : '' }}">
                  <label for="redis_hostname">
                    {{ trans('installer_messages.environment.wizard.form.redis_host') }}
                  </label>
                  <input type="text" name="redis_hostname" id="redis_hostname" value="127.0.0.1" placeholder="{{ trans('installer_messages.environment.wizard.form.redis_host') }}" />
                  @if ($errors->has('redis_host'))
                    <span class="error-block">
                              <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                              {{ $errors->first('redis_host') }}
                          </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('redis_port') ? ' has-error ' : '' }}">
                  <label for="redis_port">
                    {{ trans('installer_messages.environment.wizard.form.redis_port') }}
                  </label>
                  <input type="number" name="redis_port" id="redis_port" value="6379" placeholder="{{ trans('installer_messages.environment.wizard.form.redis_port') }}" />
                  @if ($errors->has('redis_port'))
                    <span class="error-block">
                                <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                {{ $errors->first('redis_port') }}
                            </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('redis_password') ? ' has-error ' : '' }}">
                  <label for="redis_password">
                    {{ trans('installer_messages.environment.wizard.form.redis_password_label') }}
                  </label>
                  <input type="text" name="redis_password" id="redis_password" value="" placeholder="{{ trans('installer_messages.environment.wizard.form.redis_password_placeholder') }}" />
                  @if ($errors->has('redis_password'))
                    <span class="error-block">
                              <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                              {{ $errors->first('redis_password') }}
                          </span>
                  @endif
                </div>

                <div class="buttons">
                    <button class="button" type="submit">
                        {{ trans('installer_messages.environment.wizard.form.buttons.install') }}
                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('scripts')
  <script type="text/javascript">
      function checkEnvironment(val) {
          var element=document.getElementById('environment_text_input');
          if(val=='other') {
              element.style.display='block';
          } else {
              element.style.display='none';
          }
      }
      function showDatabaseSettings() {
          document.getElementById('tab2').checked = true;
      }
      function showApplicationSettings() {
          document.getElementById('tab3').checked = true;
      }
  </script>
@endsection
