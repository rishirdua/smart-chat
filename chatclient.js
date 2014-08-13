

		//
		// Global variables
		//
		var isFirefox;
		var isIE;
		var timeout;
		var pingtimeout;
		var textFocus   = true;
		var starsadded  = false;
		var md4hash     = 0;
		var timedout    = 0;
		var pingsent	= 0;
		var requestsent = 0;
		var postsent	= 0;
		var chatsent	= 0;
		var pingRate	= 1000 * 30;	 // 30 seconds
		var refreshRate = 1000 * 1;		 // two seconds
		var rnd			= Math.random(); // random seed
		
		// added to reduce server load
		var t = 0;
		var update_period = 3;
		var throttle_back = 60;  // this is in multiples of refreshRate
		var lastpost = 0;        // throttling reduces traffic by 
		
		//
		// Get an XMLHttpRequest object
		//
		function getAjax() {
          var xmlhttp;
          
          if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
            try {
              xmlhttp = new XMLHttpRequest();
            } catch (e) {
              xmlhttp = false;
            }
		  }
          return xmlhttp;
        }
		//
		// Get browser type
		//
		function sniff() {
		
			var ff = "Netscape";
			var ie = "Microsoft Internet Explorer";
			
			isFirefox = ( navigator.appName == ff );
			isIE = (navigator.appName == ie ); 
		}
		//
		// Measure and display the char count
		//
		function charCount()
		{
			if( isFirefox ) {
			
				charcount = document.getElementById( "charcount" );
				
			}
			
			inputtext = document.getElementById( "mytext" );
			charcount.innerHTML = (1+inputtext.value.length) + " characters";
			lastpost = t;
		}
		//
		// Update the status text with some 
		// basic client statistics
		// 
		function updateStatus()
		{
			statistics = "<strong>Quick Stats</strong> Pings: " + pingsent + " Requests: " + requestsent + " Posts: " + postsent;
			
			if( isFirefox ) {
				stats = document.getElementById( "stats" );
			}
			
			stats.innerHTML = statistics;
		}
		//
		// Capture the enter key on 
		// the input box and initiate a
		// GET to the post url
		//
		function captureReturn( event )
		{
			if( isIE ) {
			
				event = window.event;
			}
			//
			// Supress event bubbling
			//
			if( event.keyCode == 13 ) {
				//
				// fetch the feed
				//
				postText();
				
				if( isIE ) {
				
					event.returnValue = false;
					
				} else {
				
					event.preventDefault();
				
				}
			}
			
			charCount();
		}
		//
		// Auto scroll the chat window
		// if the text exceeds the div 
		//
		function scrollChatPane()
		{
			pane = document.getElementById( "chatpane" );
			
			while( pane.scrollTop < pane.scrollHeight - pane.offsetHeight )
			{
				pane.scrollTop = pane.scrollTop + 10;
			}
		}
		//
		// Show the little loading animation
		// when the page starts
		//
		function showLoadScreen()
		{
			var loading = "<div style=\"text-align:center;\"><h4>Loading...</h4></div>";
			
			chat = document.getElementById( "chatbuffer" );
			user = document.getElementById( "userlist" );
			
			chat.innerHTML = loading;
			user.innerHTML = loading;
		
		}
		//
		// ping the server to let 
		// it know we're still alive
		//
		function resetPing()
		{
			pingtimeout = window.setTimeout( "pingServer()", pingRate );
		}
		//
		// Start the fetch timer to update
		// the chatpane and userlist
		//
		function setTimers()
		{
			timeout = window.setTimeout( "fetch()", refreshRate );
		}
		//
		// Start the async fetch 
		// and reset the fetch timer
		//
		function fetch()
		{
			window.clearTimeout( timeout );
			fetchBufferText();
			if(t++ % update_period) { 
			  fetchUserList();
			}    
			
			if( t - lastpost > throttle_back ) {
			  refreshRate = 5000;
			  update_period = 2;
			} else {
			/*  alert("not throttled");
			  refreshRate = 2000;
			  update_period = 3; */
			}
			
			if( timedout != 1 ) { setTimers(); }
		}
		/* #############################
		 * 
		 * function: fetchUserList()
		 * purpose:
		 * 
		 * This function retrieves the userlist.  
		 * The userlist is returned as a set of
		 * list-items from the server.  The existing
		 * list is replaced and the new list is rendered
		 * between two <ul> tags.  This function will 
		 * call to update the chat buffer when it completes.
		 *		 
		 * notes: A random number is generated 
		 * when this page loads.  This number is
		 * incrimented and appended to the url to
		 * prevent caching problems in IE
		 *
		 * #############################
		*/
		function fetchUserList()
		{
			rnd++;
			url = 'userlist.php?' + rnd;
			req = getAjax();
			
			req.onreadystatechange = function(){
			
				if( req.readyState == 4 && req.status == 200 ) {
				
					obj = document.getElementById( "userlist" );
					obj.innerHTML = req.responseText;
					fetchBufferText();
				}
			
			}
			
			req.open( 'GET', url, true );
			req.send( null );
			
			requestsent++;
			updateStatus();
		}
		/* #############################
		 * 
		 * function: fetchBufferText()
		 * purpose:
		 * 
		 * This function retrieves the last 
		 * twenty lines of the chat buffer.
		 * The chat buffer is returned as a 
		 * set of list-items and are rendered
		 * in a <ul> tag.  This function calls
		 * the scroll function to scroll the 
		 * chat pane.
		 *
		 * notes: A random number is generated 
		 * when this page loads.  This number is
		 * incrimented and appended to the url to
		 * prevent caching problems in IE
		 *
		 * #############################
		*/
		function fetchBufferText()
		{
			user = location.search.substring( 1, location.search.length );
			url = 'buffertext.php?u=' + user + '&rand=' + rnd;
			req = getAjax();
			
			req.onreadystatechange = function(){
			
				if( req.readyState == 4 && req.status == 200 ) {
				
					obj = document.getElementById( "chatbuffer" );
					obj.innerHTML = req.responseText;
					var timeoutstring = user + "timeout";
					if( obj.innerHTML.indexOf(timeoutstring) != -1 ) {
					  obj.innerHTML = obj.innerHTML.replace(timeoutstring,"");
					  timedout = 1;
					}
					scrollChatPane();
				}
			}
			
			req.open( 'GET', url , true );
			req.send( null );
			
			requestsent++;
			updateStatus();
			//changeTitle(); // this doesn't work
		}
		/* #############################
		 * 
		 * function: postText()
		 * purpose:
		 * 
		 * A users chat is posted to the server in 
		 * the querystring of the posttext.aspx url.
		 * The format of the querystring is: 
		 *
		 * ?u=[username]&t=[chat text]
		 *
		 * Because of the nature of the url encoding
		 * certain chat text will fail to post.  
		 * The chat text cannot contain any values
		 * that are invalid in a url, or are part
		 * of the url structure, such as the ampersand (&)
		 * forward slash (/), etc.  
		 *
		 * #############################
		*/
		function postText()
		{
			chatbox = document.getElementById( "mytext" );
			chat = escape(chatbox.value);
			chatbox.value = '';
			if(chat.length == 0 ) {return; }

			user = location.search.substring( 1, location.search.length );
			url = 'posttext.php?u=' + user + '&rand=' + rnd + '&t=' + chat ;
			
			req = getAjax();
			
			req.onreadystatechange = function(){
			
				if( req.readyState == 4 && req.status == 200 ) {
					fetch();
					updateReco();
				}
			
			}
			
			req.open( 'GET', url, true );
			req.send( null );
			
			lastpost = t;
			postsent++;
			updateStatus();
		}
		function updateReco() {
			
			url = 'recommend.php';
			req = getAjax();
			
			req.onreadystatechange = function(){
				if( req.readyState == 4 && req.status == 200 ) {
					
					obj = document.getElementById( "recotext" );
					obj.innerHTML = req.responseText;
					// code to get user's click
					
					var recolinks = document.getElementsByClassName('recolink');
					for(var i = 0; i < recolinks.length; i++) {
						var anchor = recolinks[i];
						anchor.onclick = function() {
							hg = getAjax();
							hg.open('GET','updatescore.php?cat=' + this.getAttribute('category') + '&text=' + document.getElementById('currenttext').innerHTML + '&label=' + document.getElementById('currenttext').getAttribute('label'));
							hg.send(null);
							return true;
						}
					}
					
					var feedbacklinks = document.getElementsByClassName('feedbacklink');
					for(var i = 0; i < feedbacklinks.length; i++) {
						var anchor = feedbacklinks[i];
						anchor.onclick = function() {
							hg = getAjax();
							hg.open('GET','updatecorpus.php?text='+document.getElementById('currenttext').innerHTML + '&label=' + this.getAttribute('category'));
							hg.send(null);
							return false;
						}
					}
					
					
					
				}
			
			}
			
			req.open( 'GET', url, true );
			req.send( null );
			
			
			
				
			
			
		}
		
		
		/* #############################
		 * 
		 * function: pinServer()
		 * purpose:
		 * 
		 * A sends a message to the server indicating
		 * the browser is still open and the user is
		 * still alive.
		 *
		 * #############################
		*/
		function pingServer()
		{
			window.clearTimeout( pingtimeout );
			
			user = location.search.substring( 1, location.search.length );
			url = 'ping.php?u=' + user + '&rand=' + rnd;
			
			req = getAjax();
			req.open( 'GET', url, true );
			req.send( null );
			
			pingsent++;
			updateStatus();
			
			if(timedout != 1) { 
			  resetPing(); 
			}
		}
		
		function startChat()
		{
			sniff();
			pingServer();
			showLoadScreen();
			setTimers();
			resetPing();
			
			if( isFirefox ) {
				mytext = document.getElementById( "mytext" );
			}
			mytext.focus();
			mytext.onkeypress = captureReturn;
		}
					
		function changeTitle( text ) {
			obj = document.getElementById( "chatbuffer" );
			temp = hex_md4(obj.innerHTML);
			
			if( temp != md4hash ) {
				if( textFocus == false && starsadded == false ) {
					text = "*** ";
					if(document.all || document.getElementById){ // Browser Check
			      		document.title = text + document.title;
			   		} else {
			     	 	self.status = text + self.status; // Default to status.
					}
					starsadded = true;
				} 
				md4hash = temp;
			}
			
			if( textFocus == true ) {
				if(document.all || document.getElementById){ // Browser Check
			  		document.title = "Chatr";
		  		} else {
		     	 	self.status = "Chatr"; // Default to status.
				}
				starsadded = false;
			}
		}