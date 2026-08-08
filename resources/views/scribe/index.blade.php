<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.11.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.11.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-register">
                                <a href="#authentication-POSTapi-register">Register a new user.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-login">
                                <a href="#authentication-POSTapi-login">Log in to the application.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-logout">
                                <a href="#authentication-POSTapi-logout">Log out of the application.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-user">
                                <a href="#authentication-GETapi-user">Get the currently authenticated user.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-patients" class="tocify-header">
                <li class="tocify-item level-1" data-unique="patients">
                    <a href="#patients">Patients</a>
                </li>
                                    <ul id="tocify-subheader-patients" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="patients-GETapi-patients-search">
                                <a href="#patients-GETapi-patients-search">Search patients by term.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-GETapi-patients">
                                <a href="#patients-GETapi-patients">List all patients.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-POSTapi-patients">
                                <a href="#patients-POSTapi-patients">Create a new patient.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-GETapi-patients--patient_id-">
                                <a href="#patients-GETapi-patients--patient_id-">Show a patient.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-PUTapi-patients--patient_id-">
                                <a href="#patients-PUTapi-patients--patient_id-">Update a patient.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="patients-DELETEapi-patients--patient_id-">
                                <a href="#patients-DELETEapi-patients--patient_id-">Delete a patient.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-appointments" class="tocify-header">
                <li class="tocify-item level-1" data-unique="appointments">
                    <a href="#appointments">Appointments</a>
                </li>
                                    <ul id="tocify-subheader-appointments" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="appointments-GETapi-appointments">
                                <a href="#appointments-GETapi-appointments">List all appointments.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-POSTapi-appointments">
                                <a href="#appointments-POSTapi-appointments">Create a new appointment.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-GETapi-appointments--appointment_id-">
                                <a href="#appointments-GETapi-appointments--appointment_id-">Show an appointment.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-PUTapi-appointments--appointment_id-">
                                <a href="#appointments-PUTapi-appointments--appointment_id-">Update an appointment.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="appointments-DELETEapi-appointments--appointment_id-">
                                <a href="#appointments-DELETEapi-appointments--appointment_id-">Delete an appointment.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-text-bruts" class="tocify-header">
                <li class="tocify-item level-1" data-unique="text-bruts">
                    <a href="#text-bruts">Text Bruts</a>
                </li>
                                    <ul id="tocify-subheader-text-bruts" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="text-bruts-POSTapi-text-bruts">
                                <a href="#text-bruts-POSTapi-text-bruts">Create a new text brut.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="text-bruts-GETapi-text-bruts--textBrut_id-">
                                <a href="#text-bruts-GETapi-text-bruts--textBrut_id-">Show a text brut.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="text-bruts-PUTapi-text-bruts--textBrut_id-">
                                <a href="#text-bruts-PUTapi-text-bruts--textBrut_id-">Update a text brut.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-ai-analysis" class="tocify-header">
                <li class="tocify-item level-1" data-unique="ai-analysis">
                    <a href="#ai-analysis">AI Analysis</a>
                </li>
                                    <ul id="tocify-subheader-ai-analysis" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="ai-analysis-POSTapi-text-bruts--textBrut_id--analyze">
                                <a href="#ai-analysis-POSTapi-text-bruts--textBrut_id--analyze">Analyze a text brut with AI.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ai-analysis-POSTapi-text-bruts--textBrut_id--validate">
                                <a href="#ai-analysis-POSTapi-text-bruts--textBrut_id--validate">Validate a text brut.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-consultations" class="tocify-header">
                <li class="tocify-item level-1" data-unique="consultations">
                    <a href="#consultations">Consultations</a>
                </li>
                                    <ul id="tocify-subheader-consultations" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="consultations-GETapi-consultations">
                                <a href="#consultations-GETapi-consultations">List all consultations.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="consultations-GETapi-consultations--consultation_id-">
                                <a href="#consultations-GETapi-consultations--consultation_id-">Show a consultation.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: August 7, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>MediNote is an AI-powered medical practice management system. It allows physicians to transform free-text consultation notes into structured medical records using Artificial Intelligence.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-POSTapi-register">Register a new user.</h2>

<p>
</p>

<p>Creates a new user account with the provided credentials and returns an API authentication token.
The account is created with the "assistant" role by default. Both doctors and assistants can access the system,
but only doctors can create consultations and use AI analysis features.</p>

<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Dr. Jane Doe\",
    \"email\": \"doctor@example.com\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Dr. Jane Doe",
    "email": "doctor@example.com",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Dr. Jane Doe&quot;,
        &quot;email&quot;: &quot;doctor@example.com&quot;,
        &quot;role&quot;: &quot;assistant&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    },
    &quot;token&quot;: &quot;1|laravel_sanctum_token_here&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The name field is required.&quot;,
    &quot;errors&quot;: {
        &quot;name&quot;: [
            &quot;The name field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="Dr. Jane Doe"
               data-component="body">
    <br>
<p>The full name of the user. Example: <code>Dr. Jane Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="doctor@example.com"
               data-component="body">
    <br>
<p>The email address of the user. Must be unique. Example: <code>doctor@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="password123"
               data-component="body">
    <br>
<p>The user password. Must be at least 8 characters. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-login">Log in to the application.</h2>

<p>
</p>

<p>Authenticates a user with their email address and password, returning an API authentication token on success.
The returned token must be included in the Authorization header as a Bearer token for all subsequent authenticated requests.</p>

<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"doctor@example.com\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "doctor@example.com",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Dr. Jane Doe&quot;,
        &quot;email&quot;: &quot;doctor@example.com&quot;,
        &quot;role&quot;: &quot;assistant&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    },
    &quot;token&quot;: &quot;1|laravel_sanctum_token_here&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email field is required.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="doctor@example.com"
               data-component="body">
    <br>
<p>The email address of the user. Example: <code>doctor@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="password123"
               data-component="body">
    <br>
<p>The user password. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-logout">Log out of the application.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Revokes the current user's API authentication token, effectively ending the session. The token can no longer be used for subsequent requests.</p>

<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;D&eacute;connexion r&eacute;ussie.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-GETapi-user">Get the currently authenticated user.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns the profile information of the user associated with the provided API token, including their name, email, and assigned role.</p>

<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Dr. Jane Doe&quot;,
        &quot;email&quot;: &quot;doctor@example.com&quot;,
        &quot;role&quot;: &quot;assistant&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="patients">Patients</h1>

    

                                <h2 id="patients-GETapi-patients-search">Search patients by term.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Searches the authenticated user's patients by matching the given term against the first name, last name, phone number, or address. Results are returned as a paginated list.</p>

<span id="example-requests-GETapi-patients-search">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/patients/search?q=Marie" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"q\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/patients/search"
);

const params = {
    "q": "Marie",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "q": "b"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patients-search">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;first_name&quot;: &quot;Marie&quot;,
            &quot;last_name&quot;: &quot;Curie&quot;,
            &quot;birth_date&quot;: &quot;1990-05-15&quot;,
            &quot;gender&quot;: &quot;female&quot;,
            &quot;phone&quot;: &quot;+33612345678&quot;,
            &quot;address&quot;: &quot;12 Rue de la Paix, Paris&quot;,
            &quot;allergies&quot;: &quot;Penicillin&quot;,
            &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The q field is required.&quot;,
    &quot;errors&quot;: {
        &quot;q&quot;: [
            &quot;The q field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patients-search" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patients-search"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patients-search"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patients-search" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patients-search">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patients-search" data-method="GET"
      data-path="api/patients/search"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patients-search', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patients-search"
                    onclick="tryItOut('GETapi-patients-search');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patients-search"
                    onclick="cancelTryOut('GETapi-patients-search');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patients-search"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patients/search</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patients-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patients-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-patients-search"
               value="Marie"
               data-component="query">
    <br>
<p>The search term. Example: <code>Marie</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-patients-search"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="patients-GETapi-patients">List all patients.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves a paginated list of patients belonging to the authenticated user. The results are ordered by creation date, with the most recent patients appearing first.</p>

<span id="example-requests-GETapi-patients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/patients" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/patients"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patients">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;first_name&quot;: &quot;Marie&quot;,
            &quot;last_name&quot;: &quot;Curie&quot;,
            &quot;birth_date&quot;: &quot;1990-05-15&quot;,
            &quot;gender&quot;: &quot;female&quot;,
            &quot;phone&quot;: &quot;+33612345678&quot;,
            &quot;address&quot;: &quot;12 Rue de la Paix, Paris&quot;,
            &quot;allergies&quot;: &quot;Penicillin&quot;,
            &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patients" data-method="GET"
      data-path="api/patients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patients"
                    onclick="tryItOut('GETapi-patients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patients"
                    onclick="cancelTryOut('GETapi-patients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="patients-POSTapi-patients">Create a new patient.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Registers a new patient record associated with the authenticated user. The patient information includes personal details, contact information, and known allergies.</p>

<span id="example-requests-POSTapi-patients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/patients" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"Marie\",
    \"last_name\": \"Curie\",
    \"birth_date\": \"1990-05-15\",
    \"gender\": \"female\",
    \"phone\": \"+33612345678\",
    \"address\": \"12 Rue de la Paix, Paris\",
    \"allergies\": \"Penicillin\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/patients"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "Marie",
    "last_name": "Curie",
    "birth_date": "1990-05-15",
    "gender": "female",
    "phone": "+33612345678",
    "address": "12 Rue de la Paix, Paris",
    "allergies": "Penicillin"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-patients">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;Marie&quot;,
        &quot;last_name&quot;: &quot;Curie&quot;,
        &quot;birth_date&quot;: &quot;1990-05-15&quot;,
        &quot;gender&quot;: &quot;female&quot;,
        &quot;phone&quot;: &quot;+33612345678&quot;,
        &quot;address&quot;: &quot;12 Rue de la Paix, Paris&quot;,
        &quot;allergies&quot;: &quot;Penicillin&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The first name field is required.&quot;,
    &quot;errors&quot;: {
        &quot;first_name&quot;: [
            &quot;The first name field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-patients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-patients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-patients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-patients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-patients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-patients" data-method="POST"
      data-path="api/patients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-patients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-patients"
                    onclick="tryItOut('POSTapi-patients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-patients"
                    onclick="cancelTryOut('POSTapi-patients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-patients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/patients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-patients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-patients"
               value="Marie"
               data-component="body">
    <br>
<p>The first name of the patient. Example: <code>Marie</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-patients"
               value="Curie"
               data-component="body">
    <br>
<p>The last name of the patient. Example: <code>Curie</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="POSTapi-patients"
               value="1990-05-15"
               data-component="body">
    <br>
<p>nullable The birth date of the patient. Example: <code>1990-05-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-patients"
               value="female"
               data-component="body">
    <br>
<p>The gender of the patient. Must be one of: male, female. Example: <code>female</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-patients"
               value="+33612345678"
               data-component="body">
    <br>
<p>nullable The phone number of the patient. Example: <code>+33612345678</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-patients"
               value="12 Rue de la Paix, Paris"
               data-component="body">
    <br>
<p>nullable The home address of the patient. Example: <code>12 Rue de la Paix, Paris</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allergies</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="allergies"                data-endpoint="POSTapi-patients"
               value="Penicillin"
               data-component="body">
    <br>
<p>nullable A description of the patient's known allergies. Example: <code>Penicillin</code></p>
        </div>
        </form>

                    <h2 id="patients-GETapi-patients--patient_id-">Show a patient.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves the complete details of a specific patient belonging to the authenticated user, including personal information, contact details, and medical allergies.</p>

<span id="example-requests-GETapi-patients--patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/patients/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/patients/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-patients--patient_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;Marie&quot;,
        &quot;last_name&quot;: &quot;Curie&quot;,
        &quot;birth_date&quot;: &quot;1990-05-15&quot;,
        &quot;gender&quot;: &quot;female&quot;,
        &quot;phone&quot;: &quot;+33612345678&quot;,
        &quot;address&quot;: &quot;12 Rue de la Paix, Paris&quot;,
        &quot;allergies&quot;: &quot;Penicillin&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-patients--patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-patients--patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-patients--patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-patients--patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-patients--patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-patients--patient_id-" data-method="GET"
      data-path="api/patients/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-patients--patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-patients--patient_id-"
                    onclick="tryItOut('GETapi-patients--patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-patients--patient_id-"
                    onclick="cancelTryOut('GETapi-patients--patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-patients--patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/patients/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-patients--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-patients--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="GETapi-patients--patient_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient"                data-endpoint="GETapi-patients--patient_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the patient. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="patients-PUTapi-patients--patient_id-">Update a patient.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Updates the details of an existing patient belonging to the authenticated user. All fields except those marked as nullable must be provided.</p>

<span id="example-requests-PUTapi-patients--patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/patients/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"Marie\",
    \"last_name\": \"Curie\",
    \"birth_date\": \"1990-05-15\",
    \"gender\": \"female\",
    \"phone\": \"+33612345678\",
    \"address\": \"12 Rue de la Paix, Paris\",
    \"allergies\": \"Penicillin\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/patients/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "Marie",
    "last_name": "Curie",
    "birth_date": "1990-05-15",
    "gender": "female",
    "phone": "+33612345678",
    "address": "12 Rue de la Paix, Paris",
    "allergies": "Penicillin"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-patients--patient_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;Marie&quot;,
        &quot;last_name&quot;: &quot;Curie&quot;,
        &quot;birth_date&quot;: &quot;1990-05-15&quot;,
        &quot;gender&quot;: &quot;female&quot;,
        &quot;phone&quot;: &quot;+33612345678&quot;,
        &quot;address&quot;: &quot;12 Rue de la Paix, Paris&quot;,
        &quot;allergies&quot;: &quot;Penicillin&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T11:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The gender field is required.&quot;,
    &quot;errors&quot;: {
        &quot;gender&quot;: [
            &quot;The gender field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-patients--patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-patients--patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-patients--patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-patients--patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-patients--patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-patients--patient_id-" data-method="PUT"
      data-path="api/patients/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-patients--patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-patients--patient_id-"
                    onclick="tryItOut('PUTapi-patients--patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-patients--patient_id-"
                    onclick="cancelTryOut('PUTapi-patients--patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-patients--patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/patients/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-patients--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-patients--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="PUTapi-patients--patient_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient"                data-endpoint="PUTapi-patients--patient_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the patient. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="PUTapi-patients--patient_id-"
               value="Marie"
               data-component="body">
    <br>
<p>The updated first name of the patient. Example: <code>Marie</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="PUTapi-patients--patient_id-"
               value="Curie"
               data-component="body">
    <br>
<p>The updated last name of the patient. Example: <code>Curie</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="PUTapi-patients--patient_id-"
               value="1990-05-15"
               data-component="body">
    <br>
<p>nullable The updated birth date of the patient. Example: <code>1990-05-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="PUTapi-patients--patient_id-"
               value="female"
               data-component="body">
    <br>
<p>The updated gender of the patient. Must be one of: male, female. Example: <code>female</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-patients--patient_id-"
               value="+33612345678"
               data-component="body">
    <br>
<p>nullable The updated phone number of the patient. Example: <code>+33612345678</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-patients--patient_id-"
               value="12 Rue de la Paix, Paris"
               data-component="body">
    <br>
<p>nullable The updated home address of the patient. Example: <code>12 Rue de la Paix, Paris</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>allergies</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="allergies"                data-endpoint="PUTapi-patients--patient_id-"
               value="Penicillin"
               data-component="body">
    <br>
<p>nullable The updated description of the patient's known allergies. Example: <code>Penicillin</code></p>
        </div>
        </form>

                    <h2 id="patients-DELETEapi-patients--patient_id-">Delete a patient.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft-deletes an existing patient belonging to the authenticated user. The record is marked as deleted but remains in the database for auditing purposes.</p>

<span id="example-requests-DELETEapi-patients--patient_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/patients/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/patients/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-patients--patient_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Patient deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-patients--patient_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-patients--patient_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-patients--patient_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-patients--patient_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-patients--patient_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-patients--patient_id-" data-method="DELETE"
      data-path="api/patients/{patient_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-patients--patient_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-patients--patient_id-"
                    onclick="tryItOut('DELETEapi-patients--patient_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-patients--patient_id-"
                    onclick="cancelTryOut('DELETEapi-patients--patient_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-patients--patient_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/patients/{patient_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-patients--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-patients--patient_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="DELETEapi-patients--patient_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the patient. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>patient</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient"                data-endpoint="DELETEapi-patients--patient_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the patient. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="appointments">Appointments</h1>

    

                                <h2 id="appointments-GETapi-appointments">List all appointments.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves a paginated list of appointments belonging to the authenticated user. Results can be filtered by status and date range.</p>

<span id="example-requests-GETapi-appointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/appointments?status=scheduled&amp;date_from=2026-01-01&amp;date_to=2026-12-31" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/appointments"
);

const params = {
    "status": "scheduled",
    "date_from": "2026-01-01",
    "date_to": "2026-12-31",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-appointments">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;patient_id&quot;: 1,
            &quot;patient&quot;: {
                &quot;id&quot;: 1,
                &quot;first_name&quot;: &quot;Marie&quot;,
                &quot;last_name&quot;: &quot;Curie&quot;
            },
            &quot;appointment_date&quot;: &quot;2026-09-15&quot;,
            &quot;appointment_time&quot;: &quot;10:30&quot;,
            &quot;reason&quot;: &quot;Annual medical check-up&quot;,
            &quot;status&quot;: &quot;scheduled&quot;,
            &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-appointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-appointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-appointments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-appointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-appointments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-appointments" data-method="GET"
      data-path="api/appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-appointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-appointments"
                    onclick="tryItOut('GETapi-appointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-appointments"
                    onclick="cancelTryOut('GETapi-appointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-appointments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/appointments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-appointments"
               value="scheduled"
               data-component="query">
    <br>
<p>Optional filter by appointment status. Must be one of: scheduled, completed, cancelled. Example: <code>scheduled</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_from"                data-endpoint="GETapi-appointments"
               value="2026-01-01"
               data-component="query">
    <br>
<p>Optional start date filter (YYYY-MM-DD). Example: <code>2026-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_to"                data-endpoint="GETapi-appointments"
               value="2026-12-31"
               data-component="query">
    <br>
<p>Optional end date filter (YYYY-MM-DD). Example: <code>2026-12-31</code></p>
            </div>
                </form>

                    <h2 id="appointments-POSTapi-appointments">Create a new appointment.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Schedules a new appointment for an existing patient. The appointment date, time, and reason are required.</p>

<span id="example-requests-POSTapi-appointments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/appointments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 1,
    \"appointment_date\": \"2026-09-15\",
    \"appointment_time\": \"10:30\",
    \"reason\": \"Annual medical check-up\",
    \"status\": \"scheduled\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/appointments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 1,
    "appointment_date": "2026-09-15",
    "appointment_time": "10:30",
    "reason": "Annual medical check-up",
    "status": "scheduled"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-appointments">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;patient_id&quot;: 1,
        &quot;patient&quot;: [],
        &quot;appointment_date&quot;: &quot;2026-09-15&quot;,
        &quot;appointment_time&quot;: &quot;10:30&quot;,
        &quot;reason&quot;: &quot;Annual medical check-up&quot;,
        &quot;status&quot;: &quot;scheduled&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The patient id field is required.&quot;,
    &quot;errors&quot;: {
        &quot;patient_id&quot;: [
            &quot;The patient id field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-appointments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-appointments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-appointments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-appointments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-appointments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-appointments" data-method="POST"
      data-path="api/appointments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-appointments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-appointments"
                    onclick="tryItOut('POSTapi-appointments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-appointments"
                    onclick="cancelTryOut('POSTapi-appointments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-appointments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/appointments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-appointments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="POSTapi-appointments"
               value="1"
               data-component="body">
    <br>
<p>The identifier of the patient. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_date"                data-endpoint="POSTapi-appointments"
               value="2026-09-15"
               data-component="body">
    <br>
<p>The date of the appointment. Example: <code>2026-09-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_time"                data-endpoint="POSTapi-appointments"
               value="10:30"
               data-component="body">
    <br>
<p>The time of the appointment in 24-hour format (HH:MM). Example: <code>10:30</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-appointments"
               value="Annual medical check-up"
               data-component="body">
    <br>
<p>The reason or purpose of the appointment. Example: <code>Annual medical check-up</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-appointments"
               value="scheduled"
               data-component="body">
    <br>
<p>nullable The status of the appointment. Must be one of: scheduled, completed, cancelled. Example: <code>scheduled</code></p>
        </div>
        </form>

                    <h2 id="appointments-GETapi-appointments--appointment_id-">Show an appointment.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves the complete details of a specific appointment belonging to the authenticated user, including the associated patient information.</p>

<span id="example-requests-GETapi-appointments--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/appointments/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/appointments/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-appointments--appointment_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;patient_id&quot;: 1,
        &quot;patient&quot;: {
            &quot;id&quot;: 1,
            &quot;first_name&quot;: &quot;Marie&quot;,
            &quot;last_name&quot;: &quot;Curie&quot;,
            &quot;birth_date&quot;: &quot;1990-05-15&quot;,
            &quot;gender&quot;: &quot;female&quot;,
            &quot;phone&quot;: &quot;+33612345678&quot;,
            &quot;address&quot;: &quot;12 Rue de la Paix, Paris&quot;,
            &quot;allergies&quot;: &quot;Penicillin&quot;,
            &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
        },
        &quot;appointment_date&quot;: &quot;2026-09-15&quot;,
        &quot;appointment_time&quot;: &quot;10:30&quot;,
        &quot;reason&quot;: &quot;Annual medical check-up&quot;,
        &quot;status&quot;: &quot;scheduled&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-appointments--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-appointments--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-appointments--appointment_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-appointments--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-appointments--appointment_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-appointments--appointment_id-" data-method="GET"
      data-path="api/appointments/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-appointments--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-appointments--appointment_id-"
                    onclick="tryItOut('GETapi-appointments--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-appointments--appointment_id-"
                    onclick="cancelTryOut('GETapi-appointments--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-appointments--appointment_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/appointments/{appointment_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-appointments--appointment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-appointments--appointment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>appointment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="appointment_id"                data-endpoint="GETapi-appointments--appointment_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the appointment. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>appointment</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="appointment"                data-endpoint="GETapi-appointments--appointment_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the appointment. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="appointments-PUTapi-appointments--appointment_id-">Update an appointment.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Updates the details of an existing appointment belonging to the authenticated user. Only the provided fields will be modified.</p>

<span id="example-requests-PUTapi-appointments--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/appointments/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"patient_id\": 1,
    \"appointment_date\": \"2026-09-15\",
    \"appointment_time\": \"10:30\",
    \"reason\": \"Follow-up consultation\",
    \"status\": \"completed\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/appointments/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "patient_id": 1,
    "appointment_date": "2026-09-15",
    "appointment_time": "10:30",
    "reason": "Follow-up consultation",
    "status": "completed"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-appointments--appointment_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;patient_id&quot;: 1,
        &quot;patient&quot;: [],
        &quot;appointment_date&quot;: &quot;2026-09-15&quot;,
        &quot;appointment_time&quot;: &quot;10:30&quot;,
        &quot;reason&quot;: &quot;Follow-up consultation&quot;,
        &quot;status&quot;: &quot;completed&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T11:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The status field must be one of scheduled, completed, cancelled.&quot;,
    &quot;errors&quot;: {
        &quot;status&quot;: [
            &quot;The status field must be one of scheduled, completed, cancelled.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-appointments--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-appointments--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-appointments--appointment_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-appointments--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-appointments--appointment_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-appointments--appointment_id-" data-method="PUT"
      data-path="api/appointments/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-appointments--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-appointments--appointment_id-"
                    onclick="tryItOut('PUTapi-appointments--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-appointments--appointment_id-"
                    onclick="cancelTryOut('PUTapi-appointments--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-appointments--appointment_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/appointments/{appointment_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>appointment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="appointment_id"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the appointment. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>appointment</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="appointment"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the appointment. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>patient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="patient_id"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="1"
               data-component="body">
    <br>
<p>nullable The updated identifier of the patient. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_date"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="2026-09-15"
               data-component="body">
    <br>
<p>nullable The updated date of the appointment. Example: <code>2026-09-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="appointment_time"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="10:30"
               data-component="body">
    <br>
<p>nullable The updated time of the appointment in 24-hour format (HH:MM). Example: <code>10:30</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="Follow-up consultation"
               data-component="body">
    <br>
<p>nullable The updated reason or purpose of the appointment. Example: <code>Follow-up consultation</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-appointments--appointment_id-"
               value="completed"
               data-component="body">
    <br>
<p>nullable The updated status of the appointment. Must be one of: scheduled, completed, cancelled. Example: <code>completed</code></p>
        </div>
        </form>

                    <h2 id="appointments-DELETEapi-appointments--appointment_id-">Delete an appointment.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft-deletes an existing appointment belonging to the authenticated user. The record is marked as deleted but remains available for historical reference.</p>

<span id="example-requests-DELETEapi-appointments--appointment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/appointments/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/appointments/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-appointments--appointment_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Appointment cancelled successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-appointments--appointment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-appointments--appointment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-appointments--appointment_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-appointments--appointment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-appointments--appointment_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-appointments--appointment_id-" data-method="DELETE"
      data-path="api/appointments/{appointment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-appointments--appointment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-appointments--appointment_id-"
                    onclick="tryItOut('DELETEapi-appointments--appointment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-appointments--appointment_id-"
                    onclick="cancelTryOut('DELETEapi-appointments--appointment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-appointments--appointment_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/appointments/{appointment_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-appointments--appointment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-appointments--appointment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>appointment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="appointment_id"                data-endpoint="DELETEapi-appointments--appointment_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the appointment. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>appointment</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="appointment"                data-endpoint="DELETEapi-appointments--appointment_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the appointment. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="text-bruts">Text Bruts</h1>

    

                                <h2 id="text-bruts-POSTapi-text-bruts">Create a new text brut.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Stores a free-text medical note written by the doctor and links it to an existing appointment. Each appointment can only have one associated text brut. Only doctors can create text bruts.</p>

<span id="example-requests-POSTapi-text-bruts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/text-bruts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"appointment_id\": 1,
    \"content\": \"Patient presents with persistent headache and mild fever for the past two days.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/text-bruts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "appointment_id": 1,
    "content": "Patient presents with persistent headache and mild fever for the past two days."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-text-bruts">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;doctor&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Dr. Jane Doe&quot;,
            &quot;email&quot;: &quot;doctor@example.com&quot;,
            &quot;role&quot;: &quot;doctor&quot;,
            &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
        },
        &quot;appointment_id&quot;: 1,
        &quot;appointment&quot;: [],
        &quot;content&quot;: &quot;Patient presents with persistent headache and mild fever for the past two days.&quot;,
        &quot;analysis_status&quot;: &quot;pending&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The content field is required.&quot;,
    &quot;errors&quot;: {
        &quot;content&quot;: [
            &quot;The content field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-text-bruts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-text-bruts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-text-bruts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-text-bruts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-text-bruts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-text-bruts" data-method="POST"
      data-path="api/text-bruts"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-text-bruts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-text-bruts"
                    onclick="tryItOut('POSTapi-text-bruts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-text-bruts"
                    onclick="cancelTryOut('POSTapi-text-bruts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-text-bruts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/text-bruts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-text-bruts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-text-bruts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>appointment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="appointment_id"                data-endpoint="POSTapi-text-bruts"
               value="1"
               data-component="body">
    <br>
<p>The identifier of the appointment this note belongs to. Must be unique. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-text-bruts"
               value="Patient presents with persistent headache and mild fever for the past two days."
               data-component="body">
    <br>
<p>The free-text medical note written by the doctor. Example: <code>Patient presents with persistent headache and mild fever for the past two days.</code></p>
        </div>
        </form>

                    <h2 id="text-bruts-GETapi-text-bruts--textBrut_id-">Show a text brut.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves the details of a specific text brut belonging to the authenticated doctor, including the associated appointment, content, and current analysis status.</p>

<span id="example-requests-GETapi-text-bruts--textBrut_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/text-bruts/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/text-bruts/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-text-bruts--textBrut_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;doctor&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Dr. Jane Doe&quot;,
            &quot;email&quot;: &quot;doctor@example.com&quot;,
            &quot;role&quot;: &quot;doctor&quot;,
            &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
        },
        &quot;appointment_id&quot;: 1,
        &quot;appointment&quot;: [],
        &quot;content&quot;: &quot;Patient presents with persistent headache and mild fever for the past two days.&quot;,
        &quot;analysis_status&quot;: &quot;pending&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-text-bruts--textBrut_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-text-bruts--textBrut_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-text-bruts--textBrut_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-text-bruts--textBrut_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-text-bruts--textBrut_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-text-bruts--textBrut_id-" data-method="GET"
      data-path="api/text-bruts/{textBrut_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-text-bruts--textBrut_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-text-bruts--textBrut_id-"
                    onclick="tryItOut('GETapi-text-bruts--textBrut_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-text-bruts--textBrut_id-"
                    onclick="cancelTryOut('GETapi-text-bruts--textBrut_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-text-bruts--textBrut_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/text-bruts/{textBrut_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-text-bruts--textBrut_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-text-bruts--textBrut_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut_id"                data-endpoint="GETapi-text-bruts--textBrut_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the textBrut. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut"                data-endpoint="GETapi-text-bruts--textBrut_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the text brut. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="text-bruts-PUTapi-text-bruts--textBrut_id-">Update a text brut.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Updates the content of an existing text brut belonging to the authenticated doctor. Once the text brut has been analyzed or validated, it can no longer be modified.</p>

<span id="example-requests-PUTapi-text-bruts--textBrut_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/text-bruts/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"content\": \"Updated note: patient reports improved symptoms after medication.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/text-bruts/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "content": "Updated note: patient reports improved symptoms after medication."
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-text-bruts--textBrut_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;doctor&quot;: [],
        &quot;appointment_id&quot;: 1,
        &quot;appointment&quot;: [],
        &quot;content&quot;: &quot;Updated note: patient reports improved symptoms after medication.&quot;,
        &quot;analysis_status&quot;: &quot;pending&quot;,
        &quot;created_at&quot;: &quot;2026-08-07T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T11:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The text can no longer be modified after AI analysis.&quot;,
    &quot;errors&quot;: {
        &quot;analysis_status&quot;: [
            &quot;The text can no longer be modified after AI analysis.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-text-bruts--textBrut_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-text-bruts--textBrut_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-text-bruts--textBrut_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-text-bruts--textBrut_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-text-bruts--textBrut_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-text-bruts--textBrut_id-" data-method="PUT"
      data-path="api/text-bruts/{textBrut_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-text-bruts--textBrut_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-text-bruts--textBrut_id-"
                    onclick="tryItOut('PUTapi-text-bruts--textBrut_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-text-bruts--textBrut_id-"
                    onclick="cancelTryOut('PUTapi-text-bruts--textBrut_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-text-bruts--textBrut_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/text-bruts/{textBrut_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-text-bruts--textBrut_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-text-bruts--textBrut_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut_id"                data-endpoint="PUTapi-text-bruts--textBrut_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the textBrut. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut"                data-endpoint="PUTapi-text-bruts--textBrut_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the text brut. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="PUTapi-text-bruts--textBrut_id-"
               value="Updated note: patient reports improved symptoms after medication."
               data-component="body">
    <br>
<p>nullable The updated free-text medical note. Example: <code>Updated note: patient reports improved symptoms after medication.</code></p>
        </div>
        </form>

                <h1 id="ai-analysis">AI Analysis</h1>

    

                                <h2 id="ai-analysis-POSTapi-text-bruts--textBrut_id--analyze">Analyze a text brut with AI.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Triggers an asynchronous AI analysis of the text brut content. The AI extracts structured medical information including the consultation reason, symptoms, observations, diagnosis, prescriptions, and follow-up recommendations. The text brut status changes to "pending" and then to "analyzed" once processing completes. Only doctors can trigger analysis.</p>

<span id="example-requests-POSTapi-text-bruts--textBrut_id--analyze">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/text-bruts/16/analyze" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/text-bruts/16/analyze"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-text-bruts--textBrut_id--analyze">
            <blockquote>
            <p>Example response (202):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;AI analysis started.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The AI analysis has already been completed.&quot;,
    &quot;errors&quot;: {
        &quot;analysis_status&quot;: [
            &quot;The AI analysis has already been completed.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-text-bruts--textBrut_id--analyze" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-text-bruts--textBrut_id--analyze"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-text-bruts--textBrut_id--analyze"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-text-bruts--textBrut_id--analyze" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-text-bruts--textBrut_id--analyze">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-text-bruts--textBrut_id--analyze" data-method="POST"
      data-path="api/text-bruts/{textBrut_id}/analyze"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-text-bruts--textBrut_id--analyze', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-text-bruts--textBrut_id--analyze"
                    onclick="tryItOut('POSTapi-text-bruts--textBrut_id--analyze');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-text-bruts--textBrut_id--analyze"
                    onclick="cancelTryOut('POSTapi-text-bruts--textBrut_id--analyze');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-text-bruts--textBrut_id--analyze"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/text-bruts/{textBrut_id}/analyze</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-text-bruts--textBrut_id--analyze"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-text-bruts--textBrut_id--analyze"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut_id"                data-endpoint="POSTapi-text-bruts--textBrut_id--analyze"
               value="16"
               data-component="url">
    <br>
<p>The ID of the textBrut. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut"                data-endpoint="POSTapi-text-bruts--textBrut_id--analyze"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the text brut to analyze. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="ai-analysis-POSTapi-text-bruts--textBrut_id--validate">Validate a text brut.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Validates the AI-analyzed text brut and persists the structured medical information as a consultation record. Once validated, the text brut status changes to "validated" and can no longer be modified. Only doctors can validate a text brut.</p>

<span id="example-requests-POSTapi-text-bruts--textBrut_id--validate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/text-bruts/16/validate" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/text-bruts/16/validate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-text-bruts--textBrut_id--validate">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;text_brut_id&quot;: 1,
        &quot;text_brut&quot;: [],
        &quot;chief_complaint&quot;: &quot;Headache&quot;,
        &quot;symptoms&quot;: [
            &quot;Headache&quot;,
            &quot;Fever&quot;
        ],
        &quot;observations&quot;: &quot;Patient presents with persistent headache and mild fever for the past two days.&quot;,
        &quot;diagnosis&quot;: &quot;Viral infection&quot;,
        &quot;follow_up_date&quot;: &quot;2026-09-01&quot;,
        &quot;validated_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;,
        &quot;prescriptions&quot;: [
            {
                &quot;medication_name&quot;: &quot;Ibuprofen&quot;,
                &quot;dosage&quot;: &quot;400mg&quot;,
                &quot;frequency&quot;: &quot;3x/day&quot;,
                &quot;duration&quot;: &quot;5 days&quot;,
                &quot;instructions&quot;: null
            }
        ],
        &quot;created_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The AI analysis has not finished yet.&quot;,
    &quot;errors&quot;: {
        &quot;analysis_status&quot;: [
            &quot;The AI analysis has not finished yet.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-text-bruts--textBrut_id--validate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-text-bruts--textBrut_id--validate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-text-bruts--textBrut_id--validate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-text-bruts--textBrut_id--validate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-text-bruts--textBrut_id--validate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-text-bruts--textBrut_id--validate" data-method="POST"
      data-path="api/text-bruts/{textBrut_id}/validate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-text-bruts--textBrut_id--validate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-text-bruts--textBrut_id--validate"
                    onclick="tryItOut('POSTapi-text-bruts--textBrut_id--validate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-text-bruts--textBrut_id--validate"
                    onclick="cancelTryOut('POSTapi-text-bruts--textBrut_id--validate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-text-bruts--textBrut_id--validate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/text-bruts/{textBrut_id}/validate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-text-bruts--textBrut_id--validate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-text-bruts--textBrut_id--validate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut_id"                data-endpoint="POSTapi-text-bruts--textBrut_id--validate"
               value="16"
               data-component="url">
    <br>
<p>The ID of the textBrut. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>textBrut</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="textBrut"                data-endpoint="POSTapi-text-bruts--textBrut_id--validate"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the text brut to validate. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="consultations">Consultations</h1>

    

                                <h2 id="consultations-GETapi-consultations">List all consultations.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves a paginated list of validated consultations belonging to the authenticated user. Each consultation contains structured medical information extracted by the AI from the original text brut.</p>

<span id="example-requests-GETapi-consultations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/consultations" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/consultations"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-consultations">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;text_brut_id&quot;: 1,
            &quot;text_brut&quot;: [],
            &quot;chief_complaint&quot;: &quot;Headache&quot;,
            &quot;symptoms&quot;: [
                &quot;Headache&quot;,
                &quot;Fever&quot;
            ],
            &quot;observations&quot;: &quot;Patient presents with persistent headache and mild fever for the past two days.&quot;,
            &quot;diagnosis&quot;: &quot;Viral infection&quot;,
            &quot;follow_up_date&quot;: &quot;2026-09-01&quot;,
            &quot;validated_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;,
            &quot;prescriptions&quot;: [
                {
                    &quot;medication_name&quot;: &quot;Ibuprofen&quot;,
                    &quot;dosage&quot;: &quot;400mg&quot;,
                    &quot;frequency&quot;: &quot;3x/day&quot;,
                    &quot;duration&quot;: &quot;5 days&quot;,
                    &quot;instructions&quot;: null
                }
            ],
            &quot;created_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-consultations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-consultations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-consultations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-consultations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-consultations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-consultations" data-method="GET"
      data-path="api/consultations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-consultations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-consultations"
                    onclick="tryItOut('GETapi-consultations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-consultations"
                    onclick="cancelTryOut('GETapi-consultations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-consultations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/consultations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-consultations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-consultations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="consultations-GETapi-consultations--consultation_id-">Show a consultation.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieves the details of a specific validated consultation belonging to the authenticated user, including the linked text brut, extracted medical information, diagnosis, and prescriptions.</p>

<span id="example-requests-GETapi-consultations--consultation_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/consultations/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/consultations/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-consultations--consultation_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;text_brut_id&quot;: 1,
        &quot;text_brut&quot;: {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 1,
            &quot;content&quot;: &quot;Patient presents with persistent headache and mild fever for the past two days.&quot;,
            &quot;analysis_status&quot;: &quot;validated&quot;
        },
        &quot;chief_complaint&quot;: &quot;Headache&quot;,
        &quot;symptoms&quot;: [
            &quot;Headache&quot;,
            &quot;Fever&quot;
        ],
        &quot;observations&quot;: &quot;Patient presents with persistent headache and mild fever for the past two days.&quot;,
        &quot;diagnosis&quot;: &quot;Viral infection&quot;,
        &quot;follow_up_date&quot;: &quot;2026-09-01&quot;,
        &quot;validated_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;,
        &quot;prescriptions&quot;: [
            {
                &quot;medication_name&quot;: &quot;Ibuprofen&quot;,
                &quot;dosage&quot;: &quot;400mg&quot;,
                &quot;frequency&quot;: &quot;3x/day&quot;,
                &quot;duration&quot;: &quot;5 days&quot;,
                &quot;instructions&quot;: null
            }
        ],
        &quot;created_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-08-07T10:05:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-consultations--consultation_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-consultations--consultation_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-consultations--consultation_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-consultations--consultation_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-consultations--consultation_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-consultations--consultation_id-" data-method="GET"
      data-path="api/consultations/{consultation_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-consultations--consultation_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-consultations--consultation_id-"
                    onclick="tryItOut('GETapi-consultations--consultation_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-consultations--consultation_id-"
                    onclick="cancelTryOut('GETapi-consultations--consultation_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-consultations--consultation_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/consultations/{consultation_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-consultations--consultation_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-consultations--consultation_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>consultation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="consultation_id"                data-endpoint="GETapi-consultations--consultation_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the consultation. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>consultation</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="consultation"                data-endpoint="GETapi-consultations--consultation_id-"
               value="1"
               data-component="url">
    <br>
<p>The unique identifier of the consultation. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
