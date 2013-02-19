var FancyWebSocket = function(url)
{
    var callbacks = {};
    var ws_url = url;
    var conn;

    this.bind = function(event_name, callback){
        callbacks[event_name] = callbacks[event_name] || [];
        callbacks[event_name].push(callback);
        return this;// chainable
    };

    this.send = function(event_name, event_data){
        //alert(this.conn);
        console.log(this.conn);
        this.conn.send( event_data );
        return this;
    };

    this.connect = function() {
        if ( typeof(MozWebSocket) == 'function' ){
            this.conn = new MozWebSocket(url);
            //alert(2);
        }else{
            this.conn = new WebSocket(url);
            //alert(5);
        }
        
        // dispatch to the right handlers
        this.conn.onmessage = function(evt){
            dispatch('message', evt.data);
        };

        this.conn.onclose = function(){dispatch('close',null)}
        this.conn.onopen = function(){dispatch('open',null)}
    };

    this.reconnect = function(event_name, event_data) {
        if ( typeof(MozWebSocket) == 'function' ){
            this.conn = new MozWebSocket(url);
            //alert(2);
        }else{
            this.conn = new WebSocket(url);
            //alert(5);
        }
        
        // dispatch to the right handlers
        this.conn.onmessage = function(evt){
            dispatch('message', evt.data);
        };

        this.conn.onclose = function(){dispatch('close',null)}
        this.conn.onopen = function(){dispatch('open',null)}
        console.log(this.conn);
        this.conn.send( event_data );
        return this;
    };

    this.disconnect = function() {
        this.conn.close();
    };

    var dispatch = function(event_name, message){
        var chain = callbacks[event_name];
        if(typeof chain == 'undefined') return; // no callbacks for this event
        for(var i = 0; i < chain.length; i++){
            chain[i]( message )
        }
    }
};