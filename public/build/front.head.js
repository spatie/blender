/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/build/";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	__webpack_require__(350);

	__webpack_require__(375);

	__webpack_require__(377);

	__webpack_require__(378);

	__webpack_require__(379);

	var _webfontloader = __webpack_require__(382);

	var _webfontloader2 = _interopRequireDefault(_webfontloader);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	_webfontloader2.default.load({
	    custom: {
	        families: ['FontAwesome'],
	        urls: ['/fonts/font-awesome/css/font-awesome.min.css'],
	        testStrings: {
	            FontAwesome: '\uE800'
	        }
	    }
	});

/***/ },

/***/ 350:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351);
	var testAllProps = __webpack_require__(354);

	/*!
	{
	  "name": "CSS Animations",
	  "property": "cssanimations",
	  "caniuse": "css-animation",
	  "polyfills": ["transformie", "csssandpaper"],
	  "tags": ["css"],
	  "warnings": ["Android < 4 will pass this test, but can only animate a single property at a time"],
	  "notes": [{
	    "name" : "Article: 'Dispelling the Android CSS animation myths'",
	    "href": "http://goo.gl/CHVJm"
	  }]
	}
	!*/

	  Modernizr.addTest('cssanimations', testAllProps('animationName', 'a', true));



/***/ },

/***/ 351:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);


	  // Fake some of Object.create
	  // so we can force non test results
	  // to be non "own" properties.
	  var Modernizr = function(){};
	  Modernizr.prototype = ModernizrProto;

	  // Leak modernizr globally when you `require` it
	  // rather than force it here.
	  // Overwrite name so constructor name is nicer :D
	  Modernizr = new Modernizr();

	  

	module.exports = Modernizr;

/***/ },

/***/ 352:
/***/ function(module, exports, __webpack_require__) {

	var tests = __webpack_require__(353);


	  var ModernizrProto = {
	    // The current version, dummy
	    _version: 'v3.0.0pre',

	    // Any settings that don't work as separate modules
	    // can go in here as configuration.
	    _config: {
	      classPrefix : '',
	      enableClasses : true
	    },

	    // Queue of tests
	    _q: [],

	    // Stub these for people who are listening
	    on: function( test, cb ) {
	      // I don't really think people should do this, but we can
	      // safe guard it a bit.
	      // -- NOTE:: this gets WAY overridden in src/addTest for
	      // actual async tests. This is in case people listen to
	      // synchronous tests. I would leave it out, but the code
	      // to *disallow* sync tests in the real version of this
	      // function is actually larger than this.
	      setTimeout(function() {
	        cb(this[test]);
	      }, 0);
	    },

	    addTest: function( name, fn, options ) {
	      tests.push({name : name, fn : fn, options : options });
	    },

	    addAsyncTest: function (fn) {
	      tests.push({name : null, fn : fn});
	    }
	  };

	  

	module.exports = ModernizrProto;

/***/ },

/***/ 353:
/***/ function(module, exports) {

	
	  var tests = [];
	  
	module.exports = tests;

/***/ },

/***/ 354:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);
	var testPropsAll = __webpack_require__(355);


	  /**
	   * testAllProps determines whether a given CSS property, in some prefixed
	   * form, is supported by the browser. It can optionally be given a value; in
	   * which case testAllProps will only return true if the browser supports that
	   * value for the named property; this latter case will use native detection
	   * (via window.CSS.supports) if available. A boolean can be passed as a 3rd
	   * parameter to skip the value check when native detection isn't available,
	   * to improve performance when simply testing for support of a property.
	   *
	   * @param prop - String naming the property to test
	   * @param value - [optional] String of the value to test
	   * @param skipValueTest - [optional] Whether to skip testing that the value
	   *                        is supported when using non-native detection
	   *                        (default: false)
	   */
	    function testAllProps (prop, value, skipValueTest) {
	        return testPropsAll(prop, undefined, undefined, value, skipValueTest);
	    }
	    ModernizrProto.testAllProps = testAllProps;
	    

	module.exports = testAllProps;

/***/ },

/***/ 355:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);
	var cssomPrefixes = __webpack_require__(356);
	var is = __webpack_require__(358);
	var testProps = __webpack_require__(359);
	var domPrefixes = __webpack_require__(369);
	var testDOMProps = __webpack_require__(370);
	var prefixes = __webpack_require__(374);


	    /**
	     * testPropsAll tests a list of DOM properties we want to check against.
	     *     We specify literally ALL possible (known and/or likely) properties on
	     *     the element including the non-vendor prefixed one, for forward-
	     *     compatibility.
	     */
	    function testPropsAll( prop, prefixed, elem, value, skipValueTest ) {

	        var ucProp = prop.charAt(0).toUpperCase() + prop.slice(1),
	            props = (prop + ' ' + cssomPrefixes.join(ucProp + ' ') + ucProp).split(' ');

	        // did they call .prefixed('boxSizing') or are we just testing a prop?
	        if(is(prefixed, "string") || is(prefixed, "undefined")) {
	            return testProps(props, prefixed, value, skipValueTest);

	            // otherwise, they called .prefixed('requestAnimationFrame', window[, elem])
	        } else {
	            props = (prop + ' ' + (domPrefixes).join(ucProp + ' ') + ucProp).split(' ');
	            return testDOMProps(props, prefixed, elem);
	        }
	    }

	    // Modernizr.testAllProps() investigates whether a given style property,
	    //     or any of its vendor-prefixed variants, is recognized
	    // Note that the property names must be provided in the camelCase variant.
	    // Modernizr.testAllProps('boxSizing')
	    ModernizrProto.testAllProps = testPropsAll;

	    

	module.exports = testPropsAll;

/***/ },

/***/ 356:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);
	var omPrefixes = __webpack_require__(357);


	  var cssomPrefixes = omPrefixes.split(' ');
	  ModernizrProto._cssomPrefixes = cssomPrefixes;
	  

	module.exports = cssomPrefixes;

/***/ },

/***/ 357:
/***/ function(module, exports) {

	
	  // Following spec is to expose vendor-specific style properties as:
	  //   elem.style.WebkitBorderRadius
	  // and the following would be incorrect:
	  //   elem.style.webkitBorderRadius

	  // Webkit ghosts their properties in lowercase but Opera & Moz do not.
	  // Microsoft uses a lowercase `ms` instead of the correct `Ms` in IE8+
	  //   erik.eae.net/archives/2008/03/10/21.48.10/

	  // More here: github.com/Modernizr/Modernizr/issues/issue/21
	  var omPrefixes = 'Webkit Moz O ms';
	  
	module.exports = omPrefixes;

/***/ },

/***/ 358:
/***/ function(module, exports) {

	
	  /**
	   * is returns a boolean for if typeof obj is exactly type.
	   */
	  function is( obj, type ) {
	    return typeof obj === type;
	  }
	  
	module.exports = is;

/***/ },

/***/ 359:
/***/ function(module, exports, __webpack_require__) {

	var contains = __webpack_require__(360);
	var mStyle = __webpack_require__(361);
	var createElement = __webpack_require__(363);
	var nativeTestProps = __webpack_require__(364);
	var is = __webpack_require__(358);


	  // testProps is a generic CSS / DOM property test.

	  // In testing support for a given CSS property, it's legit to test:
	  //    `elem.style[styleName] !== undefined`
	  // If the property is supported it will return an empty string,
	  // if unsupported it will return undefined.

	  // We'll take advantage of this quick test and skip setting a style
	  // on our modernizr element, but instead just testing undefined vs
	  // empty string.

	  // Because the testing of the CSS property names (with "-", as
	  // opposed to the camelCase DOM properties) is non-portable and
	  // non-standard but works in WebKit and IE (but not Gecko or Opera),
	  // we explicitly reject properties with dashes so that authors
	  // developing in WebKit or IE first don't end up with
	  // browser-specific content by accident.

	  function testProps( props, prefixed, value, skipValueTest ) {
	    skipValueTest = is(skipValueTest, 'undefined') ? false : skipValueTest;

	    // Try native detect first
	    if (!is(value, 'undefined')) {
	      var result = nativeTestProps(props, value);
	      if(!is(result, 'undefined')) {
	        return result;
	      }
	    }

	    // Otherwise do it properly
	    var afterInit, i, j, prop, before;

	    // If we don't have a style element, that means
	    // we're running async or after the core tests,
	    // so we'll need to create our own elements to use
	    if ( !mStyle.style ) {
	      afterInit = true;
	      mStyle.modElem = createElement('modernizr');
	      mStyle.style = mStyle.modElem.style;
	    }

	    // Delete the objects if we
	    // we created them.
	    function cleanElems() {
	      if (afterInit) {
	        delete mStyle.style;
	        delete mStyle.modElem;
	      }
	    }

	    for ( i in props ) {
	      prop = props[i];
	      before = mStyle.style[prop];

	      if ( !contains(prop, "-") && mStyle.style[prop] !== undefined ) {

	        // If value to test has been passed in, do a set-and-check test.
	        // 0 (integer) is a valid property value, so check that `value` isn't
	        // undefined, rather than just checking it's truthy.
	        if (!skipValueTest && !is(value, 'undefined')) {

	          // Needs a try catch block because of old IE. This is slow, but will
	          // be avoided in most cases because `skipValueTest` will be used.
	          try {
	            mStyle.style[prop] = value;
	          } catch (e) {}

	          // If the property value has changed, we assume the value used is
	          // supported. If `value` is empty string, it'll fail here (because
	          // it hasn't changed), which matches how browsers have implemented
	          // CSS.supports()
	          if (mStyle.style[prop] != before) {
	            cleanElems();
	            return prefixed == 'pfx' ? prop : true;
	          }
	        }
	        // Otherwise just return true, or the property name if this is a
	        // `prefixed()` call
	        else {
	          cleanElems();
	          return prefixed == 'pfx' ? prop : true;
	        }
	      }
	    }
	    cleanElems();
	    return false;
	  }

	  

	module.exports = testProps;

/***/ },

/***/ 360:
/***/ function(module, exports) {

	
	  /**
	   * contains returns a boolean for if substr is found within str.
	   */
	  function contains( str, substr ) {
	    return !!~('' + str).indexOf(substr);
	  }

	  
	module.exports = contains;

/***/ },

/***/ 361:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351);
	var modElem = __webpack_require__(362);


	  var mStyle = {
	    style : modElem.elem.style
	  };

	  // kill ref for gc, must happen before
	  // mod.elem is removed, so we unshift on to
	  // the front of the queue.
	  Modernizr._q.unshift(function() {
	    delete mStyle.style;
	  });

	  

	module.exports = mStyle;

/***/ },

/***/ 362:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351);
	var createElement = __webpack_require__(363);


	  /**
	   * Create our "modernizr" element that we do most feature tests on.
	   */
	  var modElem = {
	    elem : createElement('modernizr')
	  };

	  // Clean up this element
	  Modernizr._q.push(function() {
	    delete modElem.elem;
	  });

	  

	module.exports = modElem;

/***/ },

/***/ 363:
/***/ function(module, exports) {

	
	  var createElement = function() {
	    return document.createElement.apply(document, arguments);
	  };
	  
	module.exports = createElement;

/***/ },

/***/ 364:
/***/ function(module, exports, __webpack_require__) {

	var injectElementWithStyles = __webpack_require__(365);
	var domToHyphenated = __webpack_require__(368);


	    // Function to allow us to use native feature detection functionality if available.
	    // Accepts a list of property names and a single value
	    // Returns `undefined` if native detection not available
	    function nativeTestProps ( props, value ) {
	        var i = props.length;
	        // Start with the JS API: http://www.w3.org/TR/css3-conditional/#the-css-interface
	        if ('CSS' in window && 'supports' in window.CSS) {
	            // Try every prefixed variant of the property
	            while (i--) {
	                if (window.CSS.supports(domToHyphenated(props[i]), value)) {
	                    return true;
	                }
	            }
	            return false;
	        }
	        // Otherwise fall back to at-rule (for FF 17 and Opera 12.x)
	        else if ('CSSSupportsRule' in window) {
	            // Build a condition string for every prefixed variant
	            var conditionText = [];
	            while (i--) {
	                conditionText.push('(' + domToHyphenated(props[i]) + ':' + value + ')');
	            }
	            conditionText = conditionText.join(' or ');
	            return injectElementWithStyles('@supports (' + conditionText + ') { #modernizr { position: absolute; } }', function( node ) {
	                return (window.getComputedStyle ?
	                        getComputedStyle(node, null) :
	                        node.currentStyle)['position'] == 'absolute';
	            });
	        }
	        return undefined;
	    }
	    

	module.exports = nativeTestProps;

/***/ },

/***/ 365:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);
	var docElement = __webpack_require__(366);
	var createElement = __webpack_require__(363);
	var getBody = __webpack_require__(367);


	  // Inject element with style element and some CSS rules
	  function injectElementWithStyles( rule, callback, nodes, testnames ) {
	    var mod = 'modernizr';
	    var style;
	    var ret;
	    var node;
	    var docOverflow;
	    var div = createElement('div');
	    var body = getBody();

	    if ( parseInt(nodes, 10) ) {
	      // In order not to give false positives we create a node for each test
	      // This also allows the method to scale for unspecified uses
	      while ( nodes-- ) {
	        node = createElement('div');
	        node.id = testnames ? testnames[nodes] : mod + (nodes + 1);
	        div.appendChild(node);
	      }
	    }

	    // <style> elements in IE6-9 are considered 'NoScope' elements and therefore will be removed
	    // when injected with innerHTML. To get around this you need to prepend the 'NoScope' element
	    // with a 'scoped' element, in our case the soft-hyphen entity as it won't mess with our measurements.
	    // msdn.microsoft.com/en-us/library/ms533897%28VS.85%29.aspx
	    // Documents served as xml will throw if using &shy; so use xml friendly encoded version. See issue #277
	    style = ['&#173;','<style id="s', mod, '">', rule, '</style>'].join('');
	    div.id = mod;
	    // IE6 will false positive on some tests due to the style element inside the test div somehow interfering offsetHeight, so insert it into body or fakebody.
	    // Opera will act all quirky when injecting elements in documentElement when page is served as xml, needs fakebody too. #270
	    (!body.fake ? div : body).innerHTML += style;
	    body.appendChild(div);
	    if ( body.fake ) {
	      //avoid crashing IE8, if background image is used
	      body.style.background = '';
	      //Safari 5.13/5.1.4 OSX stops loading if ::-webkit-scrollbar is used and scrollbars are visible
	      body.style.overflow = 'hidden';
	      docOverflow = docElement.style.overflow;
	      docElement.style.overflow = 'hidden';
	      docElement.appendChild(body);
	    }

	    ret = callback(div, rule);
	    // If this is done after page load we don't want to remove the body so check if body exists
	    if ( body.fake ) {
	      body.parentNode.removeChild(body);
	      docElement.style.overflow = docOverflow;
	      // Trigger layout so kinetic scrolling isn't disabled in iOS6+
	      docElement.offsetHeight;
	    } else {
	      div.parentNode.removeChild(div);
	    }

	    return !!ret;

	  }

	  

	module.exports = injectElementWithStyles;

/***/ },

/***/ 366:
/***/ function(module, exports) {

	
	  var docElement = document.documentElement;
	  
	module.exports = docElement;

/***/ },

/***/ 367:
/***/ function(module, exports, __webpack_require__) {

	var createElement = __webpack_require__(363);


	  function getBody() {
	    // After page load injecting a fake body doesn't work so check if body exists
	    var body = document.body;

	    if(!body) {
	      // Can't use the real body create a fake one.
	      body = createElement('body');
	      body.fake = true;
	    }

	    return body;
	  }

	  

	module.exports = getBody;

/***/ },

/***/ 368:
/***/ function(module, exports) {

	
	    // Helper function for e.g. boxSizing -> box-sizing
	    function domToHyphenated( name ) {
	        return name.replace(/([A-Z])/g, function(str, m1) {
	            return '-' + m1.toLowerCase();
	        }).replace(/^ms-/, '-ms-');
	    }
	    
	module.exports = domToHyphenated;

/***/ },

/***/ 369:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);
	var omPrefixes = __webpack_require__(357);


	  var domPrefixes = omPrefixes.toLowerCase().split(' ');
	  ModernizrProto._domPrefixes = domPrefixes;
	  

	module.exports = domPrefixes;

/***/ },

/***/ 370:
/***/ function(module, exports, __webpack_require__) {

	var is = __webpack_require__(358);
	__webpack_require__(371);


	  /**
	   * testDOMProps is a generic DOM property test; if a browser supports
	   *   a certain property, it won't return undefined for it.
	   */
	  function testDOMProps( props, obj, elem ) {
	    var item;

	    for ( var i in props ) {
	      if ( props[i] in obj ) {

	        // return the property name as a string
	        if (elem === false) return props[i];

	        item = obj[props[i]];

	        // let's bind a function (and it has a bind method -- certain native objects that report that they are a
	        // function don't [such as webkitAudioContext])
	        if (is(item, 'function') && 'bind' in item){
	          // default to autobind unless override
	          return item.bind(elem || obj);
	        }

	        // return the unbound function or obj or value
	        return item;
	      }
	    }
	    return false;
	  }

	  

	module.exports = testDOMProps;

/***/ },

/***/ 371:
/***/ function(module, exports, __webpack_require__) {

	var slice = __webpack_require__(372);


	  // Adapted from ES5-shim https://github.com/kriskowal/es5-shim/blob/master/es5-shim.js
	  // es5.github.com/#x15.3.4.5

	  if (!Function.prototype.bind) {
	    Function.prototype.bind = function bind(that) {

	      var target = this;

	      if (typeof target != "function") {
	        throw new TypeError();
	      }

	      var args = slice.call(arguments, 1);
	      var bound = function() {

	        if (this instanceof bound) {

	          var F = function(){};
	          F.prototype = target.prototype;
	          var self = new F();

	          var result = target.apply(
	            self,
	            args.concat(slice.call(arguments))
	          );
	          if (Object(result) === result) {
	            return result;
	          }
	          return self;

	        } else {

	          return target.apply(
	            that,
	            args.concat(slice.call(arguments))
	          );

	        }

	      };

	      return bound;
	    };
	  }

	  

	module.exports = Function.prototype.bind;

/***/ },

/***/ 372:
/***/ function(module, exports, __webpack_require__) {

	var classes = __webpack_require__(373);


	  var slice = classes.slice;
	  

	module.exports = slice;

/***/ },

/***/ 373:
/***/ function(module, exports) {

	
	  var classes = [];
	  
	module.exports = classes;

/***/ },

/***/ 374:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);


	  // List of property values to set for css tests. See ticket #21
	  var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');

	  // expose these for the plugin API. Look in the source for how to join() them against your input
	  ModernizrProto._prefixes = prefixes;

	  

	module.exports = prefixes;

/***/ },

/***/ 375:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351);
	var testAllProps = __webpack_require__(354);
	var testStyles = __webpack_require__(376);
	var docElement = __webpack_require__(366);

	/*!
	{
	  "name": "CSS Transforms 3D",
	  "property": "csstransforms3d",
	  "caniuse": "transforms3d",
	  "tags": ["css"],
	  "warnings": [
	    "Chrome may occassionally fail this test on some systems; more info: https://code.google.com/p/chromium/issues/detail?id=129004"
	  ]
	}
	!*/

	  Modernizr.addTest('csstransforms3d', function() {
	    var ret = !!testAllProps('perspective', '1px', true);

	    // Webkit's 3D transforms are passed off to the browser's own graphics renderer.
	    //   It works fine in Safari on Leopard and Snow Leopard, but not in Chrome in
	    //   some conditions. As a result, Webkit typically recognizes the syntax but
	    //   will sometimes throw a false positive, thus we must do a more thorough check:
	    if ( ret && 'webkitPerspective' in docElement.style ) {

	      // Webkit allows this media query to succeed only if the feature is enabled.
	      // `@media (transform-3d),(-webkit-transform-3d){ ... }`
	      // If loaded inside the body tag and the test element inherits any padding, margin or borders it will fail #740
	      testStyles('@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:5px;margin:0;padding:0;border:0}}', function( node, rule ) {
	        ret = node.offsetLeft === 9 && node.offsetHeight === 5;
	      });
	    }

	    return ret;
	  });



/***/ },

/***/ 376:
/***/ function(module, exports, __webpack_require__) {

	var ModernizrProto = __webpack_require__(352);
	var injectElementWithStyles = __webpack_require__(365);


	  var testStyles = ModernizrProto.testStyles = injectElementWithStyles;
	  

	module.exports = testStyles;

/***/ },

/***/ 377:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351);

	/*!
	{
	  "name": "SVG",
	  "property": "svg",
	  "caniuse": "svg",
	  "tags": ["svg"],
	  "authors": ["Erik Dahlstrom"],
	  "polyfills": [
	    "svgweb",
	    "raphael",
	    "amplesdk",
	    "canvg",
	    "svg-boilerplate",
	    "sie",
	    "dojogfx",
	    "fabricjs"
	  ]
	}
	!*/
	/* DOC

	Detects support for SVG in `<embed>` or `<object>` elements.

	*/

	  Modernizr.addTest('svg', !!document.createElementNS && !!document.createElementNS('http://www.w3.org/2000/svg', 'svg').createSVGRect);



/***/ },

/***/ 378:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351);
	var prefixes = __webpack_require__(374);
	var testStyles = __webpack_require__(376);

	/*!
	{
	  "name": "Touch Events",
	  "property": "touchevents",
	  "caniuse" : "touch",
	  "tags": ["media", "attribute"],
	  "notes": [{
	    "name": "Touch Events spec",
	    "href": "http://www.w3.org/TR/2013/WD-touch-events-20130124/"
	  }],
	  "warnings": [
	    "Indicates if the browser supports the Touch Events spec, and does not necessarily reflect a touchscreen device"
	  ],
	  "knownBugs": [
	    "False-positive on some configurations of Nokia N900",
	    "False-positive on some BlackBerry 6.0 builds – https://github.com/Modernizr/Modernizr/issues/372#issuecomment-3112695"
	  ]
	}
	!*/
	/* DOC

	Indicates if the browser supports the W3C Touch Events API.

	This *does not* necessarily reflect a touchscreen device:

	* Older touchscreen devices only emulate mouse events
	* Modern IE touch devices implement the Pointer Events API instead: use `Modernizr.pointerevents` to detect support for that
	* Some browsers & OS setups may enable touch APIs when no touchscreen is connected
	* Future browsers may implement other event models for touch interactions

	See this article: [You Can't Detect A Touchscreen](http://www.stucox.com/blog/you-cant-detect-a-touchscreen/).

	It's recommended to bind both mouse and touch/pointer events simultaneously – see [this HTML5 Rocks tutorial](http://www.html5rocks.com/en/mobile/touchandmouse/).

	This test will also return `true` for Firefox 4 Multitouch support.

	*/

	  // Chrome (desktop) used to lie about its support on this, but that has since been rectified: http://crbug.com/36415
	  Modernizr.addTest('touchevents', function() {
	    var bool;
	    if(('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) {
	      bool = true;
	    } else {
	      var query = ['@media (',prefixes.join('touch-enabled),('),'heartz',')','{#modernizr{top:9px;position:absolute}}'].join('');
	      testStyles(query, function( node ) {
	        bool = node.offsetTop === 9;
	      });
	    }
	    return bool;
	  });



/***/ },

/***/ 379:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351),
	    ModernizrProto = __webpack_require__(352),
	    classes = __webpack_require__(373),
	    testRunner = __webpack_require__(380),
	    setClasses = __webpack_require__(381);

	// Run each test
	testRunner();

	// Remove the "no-js" class if it exists
	setClasses(classes);

	delete ModernizrProto.addTest;
	delete ModernizrProto.addAsyncTest;

	// Run the things that are supposed to run after the tests
	for (var i = 0; i < Modernizr._q.length; i++) {
	  Modernizr._q[i]();
	}

	module.exports = Modernizr;


/***/ },

/***/ 380:
/***/ function(module, exports, __webpack_require__) {

	var tests = __webpack_require__(353);
	var Modernizr = __webpack_require__(351);
	var classes = __webpack_require__(373);
	var is = __webpack_require__(358);


	  // Run through all tests and detect their support in the current UA.
	  function testRunner() {
	    var featureNames;
	    var feature;
	    var aliasIdx;
	    var result;
	    var nameIdx;
	    var featureName;
	    var featureNameSplit;
	    var modernizrProp;
	    var mPropCount;

	    for ( var featureIdx in tests ) {
	      featureNames = [];
	      feature = tests[featureIdx];
	      // run the test, throw the return value into the Modernizr,
	      //   then based on that boolean, define an appropriate className
	      //   and push it into an array of classes we'll join later.
	      //
	      //   If there is no name, it's an 'async' test that is run,
	      //   but not directly added to the object. That should
	      //   be done with a post-run addTest call.
	      if ( feature.name ) {
	        featureNames.push(feature.name.toLowerCase());

	        if (feature.options && feature.options.aliases && feature.options.aliases.length) {
	          // Add all the aliases into the names list
	          for (aliasIdx = 0; aliasIdx < feature.options.aliases.length; aliasIdx++) {
	            featureNames.push(feature.options.aliases[aliasIdx].toLowerCase());
	          }
	        }
	      }

	      // Run the test, or use the raw value if it's not a function
	      result = is(feature.fn, 'function') ? feature.fn() : feature.fn;


	      // Set each of the names on the Modernizr object
	      for (nameIdx = 0; nameIdx < featureNames.length; nameIdx++) {
	        featureName = featureNames[nameIdx];
	        // Support dot properties as sub tests. We don't do checking to make sure
	        // that the implied parent tests have been added. You must call them in
	        // order (either in the test, or make the parent test a dependency).
	        //
	        // Cap it to TWO to make the logic simple and because who needs that kind of subtesting
	        // hashtag famous last words
	        featureNameSplit = featureName.split('.');

	        if (featureNameSplit.length === 1) {
	          Modernizr[featureNameSplit[0]] = result;
	        }
	        else if (featureNameSplit.length === 2) {
	          Modernizr[featureNameSplit[0]][featureNameSplit[1]] = result;
	        }

	        classes.push((result ? '' : 'no-') + featureNameSplit.join('-'));
	      }
	    }
	  }

	  

	module.exports = testRunner;

/***/ },

/***/ 381:
/***/ function(module, exports, __webpack_require__) {

	var Modernizr = __webpack_require__(351);
	var docElement = __webpack_require__(366);


	  // Pass in an and array of class names, e.g.:
	  //  ['no-webp', 'borderradius', ...]
	  function setClasses( classes ) {
	    var className = docElement.className;
	    var regex;
	    var classPrefix = Modernizr._config.classPrefix || '';

	    // Change `no-js` to `js` (we do this regardles of the `enableClasses`
	    // option)
	    // Handle classPrefix on this too
	    var reJS = new RegExp('(^|\\s)'+classPrefix+'no-js(\\s|$)');
	    className = className.replace(reJS, '$1'+classPrefix+'js$2');

	    if(Modernizr._config.enableClasses) {
	      // Add the new classes
	      className += ' ' + classPrefix + classes.join(' ' + classPrefix);
	      docElement.className = className;
	    }

	  }

	  

	module.exports = setClasses;

/***/ },

/***/ 382:
/***/ function(module, exports, __webpack_require__) {

	var __WEBPACK_AMD_DEFINE_RESULT__;/* Web Font Loader v1.6.27 - (c) Adobe Systems, Google. License: Apache 2.0 */(function(){function aa(a,b,c){return a.call.apply(a.bind,arguments)}function ba(a,b,c){if(!a)throw Error();if(2<arguments.length){var d=Array.prototype.slice.call(arguments,2);return function(){var c=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(c,d);return a.apply(b,c)}}return function(){return a.apply(b,arguments)}}function p(a,b,c){p=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?aa:ba;return p.apply(null,arguments)}var q=Date.now||function(){return+new Date};function ca(a,b){this.a=a;this.m=b||a;this.c=this.m.document}var da=!!window.FontFace;function t(a,b,c,d){b=a.c.createElement(b);if(c)for(var e in c)c.hasOwnProperty(e)&&("style"==e?b.style.cssText=c[e]:b.setAttribute(e,c[e]));d&&b.appendChild(a.c.createTextNode(d));return b}function u(a,b,c){a=a.c.getElementsByTagName(b)[0];a||(a=document.documentElement);a.insertBefore(c,a.lastChild)}function v(a){a.parentNode&&a.parentNode.removeChild(a)}
	function w(a,b,c){b=b||[];c=c||[];for(var d=a.className.split(/\s+/),e=0;e<b.length;e+=1){for(var f=!1,g=0;g<d.length;g+=1)if(b[e]===d[g]){f=!0;break}f||d.push(b[e])}b=[];for(e=0;e<d.length;e+=1){f=!1;for(g=0;g<c.length;g+=1)if(d[e]===c[g]){f=!0;break}f||b.push(d[e])}a.className=b.join(" ").replace(/\s+/g," ").replace(/^\s+|\s+$/,"")}function y(a,b){for(var c=a.className.split(/\s+/),d=0,e=c.length;d<e;d++)if(c[d]==b)return!0;return!1}
	function z(a){if("string"===typeof a.f)return a.f;var b=a.m.location.protocol;"about:"==b&&(b=a.a.location.protocol);return"https:"==b?"https:":"http:"}function ea(a){return a.m.location.hostname||a.a.location.hostname}
	function A(a,b,c){function d(){k&&e&&f&&(k(g),k=null)}b=t(a,"link",{rel:"stylesheet",href:b,media:"all"});var e=!1,f=!0,g=null,k=c||null;da?(b.onload=function(){e=!0;d()},b.onerror=function(){e=!0;g=Error("Stylesheet failed to load");d()}):setTimeout(function(){e=!0;d()},0);u(a,"head",b)}
	function B(a,b,c,d){var e=a.c.getElementsByTagName("head")[0];if(e){var f=t(a,"script",{src:b}),g=!1;f.onload=f.onreadystatechange=function(){g||this.readyState&&"loaded"!=this.readyState&&"complete"!=this.readyState||(g=!0,c&&c(null),f.onload=f.onreadystatechange=null,"HEAD"==f.parentNode.tagName&&e.removeChild(f))};e.appendChild(f);setTimeout(function(){g||(g=!0,c&&c(Error("Script load timeout")))},d||5E3);return f}return null};function C(){this.a=0;this.c=null}function D(a){a.a++;return function(){a.a--;E(a)}}function F(a,b){a.c=b;E(a)}function E(a){0==a.a&&a.c&&(a.c(),a.c=null)};function G(a){this.a=a||"-"}G.prototype.c=function(a){for(var b=[],c=0;c<arguments.length;c++)b.push(arguments[c].replace(/[\W_]+/g,"").toLowerCase());return b.join(this.a)};function H(a,b){this.c=a;this.f=4;this.a="n";var c=(b||"n4").match(/^([nio])([1-9])$/i);c&&(this.a=c[1],this.f=parseInt(c[2],10))}function fa(a){return I(a)+" "+(a.f+"00")+" 300px "+J(a.c)}function J(a){var b=[];a=a.split(/,\s*/);for(var c=0;c<a.length;c++){var d=a[c].replace(/['"]/g,"");-1!=d.indexOf(" ")||/^\d/.test(d)?b.push("'"+d+"'"):b.push(d)}return b.join(",")}function K(a){return a.a+a.f}function I(a){var b="normal";"o"===a.a?b="oblique":"i"===a.a&&(b="italic");return b}
	function ga(a){var b=4,c="n",d=null;a&&((d=a.match(/(normal|oblique|italic)/i))&&d[1]&&(c=d[1].substr(0,1).toLowerCase()),(d=a.match(/([1-9]00|normal|bold)/i))&&d[1]&&(/bold/i.test(d[1])?b=7:/[1-9]00/.test(d[1])&&(b=parseInt(d[1].substr(0,1),10))));return c+b};function ha(a,b){this.c=a;this.f=a.m.document.documentElement;this.h=b;this.a=new G("-");this.j=!1!==b.events;this.g=!1!==b.classes}function ia(a){a.g&&w(a.f,[a.a.c("wf","loading")]);L(a,"loading")}function M(a){if(a.g){var b=y(a.f,a.a.c("wf","active")),c=[],d=[a.a.c("wf","loading")];b||c.push(a.a.c("wf","inactive"));w(a.f,c,d)}L(a,"inactive")}function L(a,b,c){if(a.j&&a.h[b])if(c)a.h[b](c.c,K(c));else a.h[b]()};function ja(){this.c={}}function ka(a,b,c){var d=[],e;for(e in b)if(b.hasOwnProperty(e)){var f=a.c[e];f&&d.push(f(b[e],c))}return d};function N(a,b){this.c=a;this.f=b;this.a=t(this.c,"span",{"aria-hidden":"true"},this.f)}function O(a){u(a.c,"body",a.a)}function P(a){return"display:block;position:absolute;top:-9999px;left:-9999px;font-size:300px;width:auto;height:auto;line-height:normal;margin:0;padding:0;font-variant:normal;white-space:nowrap;font-family:"+J(a.c)+";"+("font-style:"+I(a)+";font-weight:"+(a.f+"00")+";")};function Q(a,b,c,d,e,f){this.g=a;this.j=b;this.a=d;this.c=c;this.f=e||3E3;this.h=f||void 0}Q.prototype.start=function(){var a=this.c.m.document,b=this,c=q(),d=new Promise(function(d,e){function k(){q()-c>=b.f?e():a.fonts.load(fa(b.a),b.h).then(function(a){1<=a.length?d():setTimeout(k,25)},function(){e()})}k()}),e=new Promise(function(a,d){setTimeout(d,b.f)});Promise.race([e,d]).then(function(){b.g(b.a)},function(){b.j(b.a)})};function R(a,b,c,d,e,f,g){this.v=a;this.B=b;this.c=c;this.a=d;this.s=g||"BESbswy";this.f={};this.w=e||3E3;this.u=f||null;this.o=this.j=this.h=this.g=null;this.g=new N(this.c,this.s);this.h=new N(this.c,this.s);this.j=new N(this.c,this.s);this.o=new N(this.c,this.s);a=new H(this.a.c+",serif",K(this.a));a=P(a);this.g.a.style.cssText=a;a=new H(this.a.c+",sans-serif",K(this.a));a=P(a);this.h.a.style.cssText=a;a=new H("serif",K(this.a));a=P(a);this.j.a.style.cssText=a;a=new H("sans-serif",K(this.a));a=
	P(a);this.o.a.style.cssText=a;O(this.g);O(this.h);O(this.j);O(this.o)}var S={D:"serif",C:"sans-serif"},T=null;function U(){if(null===T){var a=/AppleWebKit\/([0-9]+)(?:\.([0-9]+))/.exec(window.navigator.userAgent);T=!!a&&(536>parseInt(a[1],10)||536===parseInt(a[1],10)&&11>=parseInt(a[2],10))}return T}R.prototype.start=function(){this.f.serif=this.j.a.offsetWidth;this.f["sans-serif"]=this.o.a.offsetWidth;this.A=q();la(this)};
	function ma(a,b,c){for(var d in S)if(S.hasOwnProperty(d)&&b===a.f[S[d]]&&c===a.f[S[d]])return!0;return!1}function la(a){var b=a.g.a.offsetWidth,c=a.h.a.offsetWidth,d;(d=b===a.f.serif&&c===a.f["sans-serif"])||(d=U()&&ma(a,b,c));d?q()-a.A>=a.w?U()&&ma(a,b,c)&&(null===a.u||a.u.hasOwnProperty(a.a.c))?V(a,a.v):V(a,a.B):na(a):V(a,a.v)}function na(a){setTimeout(p(function(){la(this)},a),50)}function V(a,b){setTimeout(p(function(){v(this.g.a);v(this.h.a);v(this.j.a);v(this.o.a);b(this.a)},a),0)};function W(a,b,c){this.c=a;this.a=b;this.f=0;this.o=this.j=!1;this.s=c}var X=null;W.prototype.g=function(a){var b=this.a;b.g&&w(b.f,[b.a.c("wf",a.c,K(a).toString(),"active")],[b.a.c("wf",a.c,K(a).toString(),"loading"),b.a.c("wf",a.c,K(a).toString(),"inactive")]);L(b,"fontactive",a);this.o=!0;oa(this)};
	W.prototype.h=function(a){var b=this.a;if(b.g){var c=y(b.f,b.a.c("wf",a.c,K(a).toString(),"active")),d=[],e=[b.a.c("wf",a.c,K(a).toString(),"loading")];c||d.push(b.a.c("wf",a.c,K(a).toString(),"inactive"));w(b.f,d,e)}L(b,"fontinactive",a);oa(this)};function oa(a){0==--a.f&&a.j&&(a.o?(a=a.a,a.g&&w(a.f,[a.a.c("wf","active")],[a.a.c("wf","loading"),a.a.c("wf","inactive")]),L(a,"active")):M(a.a))};function pa(a){this.j=a;this.a=new ja;this.h=0;this.f=this.g=!0}pa.prototype.load=function(a){this.c=new ca(this.j,a.context||this.j);this.g=!1!==a.events;this.f=!1!==a.classes;qa(this,new ha(this.c,a),a)};
	function ra(a,b,c,d,e){var f=0==--a.h;(a.f||a.g)&&setTimeout(function(){var a=e||null,k=d||null||{};if(0===c.length&&f)M(b.a);else{b.f+=c.length;f&&(b.j=f);var h,m=[];for(h=0;h<c.length;h++){var l=c[h],n=k[l.c],r=b.a,x=l;r.g&&w(r.f,[r.a.c("wf",x.c,K(x).toString(),"loading")]);L(r,"fontloading",x);r=null;if(null===X)if(window.FontFace){var x=/Gecko.*Firefox\/(\d+)/.exec(window.navigator.userAgent),ya=/OS X.*Version\/10\..*Safari/.exec(window.navigator.userAgent)&&/Apple/.exec(window.navigator.vendor);
	X=x?42<parseInt(x[1],10):ya?!1:!0}else X=!1;X?r=new Q(p(b.g,b),p(b.h,b),b.c,l,b.s,n):r=new R(p(b.g,b),p(b.h,b),b.c,l,b.s,a,n);m.push(r)}for(h=0;h<m.length;h++)m[h].start()}},0)}function qa(a,b,c){var d=[],e=c.timeout;ia(b);var d=ka(a.a,c,a.c),f=new W(a.c,b,e);a.h=d.length;b=0;for(c=d.length;b<c;b++)d[b].load(function(b,d,c){ra(a,f,b,d,c)})};function sa(a,b){this.c=a;this.a=b}function ta(a,b,c){var d=z(a.c);a=(a.a.api||"fast.fonts.net/jsapi").replace(/^.*http(s?):(\/\/)?/,"");return d+"//"+a+"/"+b+".js"+(c?"?v="+c:"")}
	sa.prototype.load=function(a){function b(){if(f["__mti_fntLst"+d]){var c=f["__mti_fntLst"+d](),e=[],h;if(c)for(var m=0;m<c.length;m++){var l=c[m].fontfamily;void 0!=c[m].fontStyle&&void 0!=c[m].fontWeight?(h=c[m].fontStyle+c[m].fontWeight,e.push(new H(l,h))):e.push(new H(l))}a(e)}else setTimeout(function(){b()},50)}var c=this,d=c.a.projectId,e=c.a.version;if(d){var f=c.c.m;B(this.c,ta(c,d,e),function(e){e?a([]):(f["__MonotypeConfiguration__"+d]=function(){return c.a},b())}).id="__MonotypeAPIScript__"+
	d}else a([])};function ua(a,b){this.c=a;this.a=b}ua.prototype.load=function(a){var b,c,d=this.a.urls||[],e=this.a.families||[],f=this.a.testStrings||{},g=new C;b=0;for(c=d.length;b<c;b++)A(this.c,d[b],D(g));var k=[];b=0;for(c=e.length;b<c;b++)if(d=e[b].split(":"),d[1])for(var h=d[1].split(","),m=0;m<h.length;m+=1)k.push(new H(d[0],h[m]));else k.push(new H(d[0]));F(g,function(){a(k,f)})};function va(a,b,c){a?this.c=a:this.c=b+wa;this.a=[];this.f=[];this.g=c||""}var wa="//fonts.googleapis.com/css";function xa(a,b){for(var c=b.length,d=0;d<c;d++){var e=b[d].split(":");3==e.length&&a.f.push(e.pop());var f="";2==e.length&&""!=e[1]&&(f=":");a.a.push(e.join(f))}}
	function za(a){if(0==a.a.length)throw Error("No fonts to load!");if(-1!=a.c.indexOf("kit="))return a.c;for(var b=a.a.length,c=[],d=0;d<b;d++)c.push(a.a[d].replace(/ /g,"+"));b=a.c+"?family="+c.join("%7C");0<a.f.length&&(b+="&subset="+a.f.join(","));0<a.g.length&&(b+="&text="+encodeURIComponent(a.g));return b};function Aa(a){this.f=a;this.a=[];this.c={}}
	var Ba={latin:"BESbswy","latin-ext":"\u00e7\u00f6\u00fc\u011f\u015f",cyrillic:"\u0439\u044f\u0416",greek:"\u03b1\u03b2\u03a3",khmer:"\u1780\u1781\u1782",Hanuman:"\u1780\u1781\u1782"},Ca={thin:"1",extralight:"2","extra-light":"2",ultralight:"2","ultra-light":"2",light:"3",regular:"4",book:"4",medium:"5","semi-bold":"6",semibold:"6","demi-bold":"6",demibold:"6",bold:"7","extra-bold":"8",extrabold:"8","ultra-bold":"8",ultrabold:"8",black:"9",heavy:"9",l:"3",r:"4",b:"7"},Da={i:"i",italic:"i",n:"n",normal:"n"},
	Ea=/^(thin|(?:(?:extra|ultra)-?)?light|regular|book|medium|(?:(?:semi|demi|extra|ultra)-?)?bold|black|heavy|l|r|b|[1-9]00)?(n|i|normal|italic)?$/;
	function Fa(a){for(var b=a.f.length,c=0;c<b;c++){var d=a.f[c].split(":"),e=d[0].replace(/\+/g," "),f=["n4"];if(2<=d.length){var g;var k=d[1];g=[];if(k)for(var k=k.split(","),h=k.length,m=0;m<h;m++){var l;l=k[m];if(l.match(/^[\w-]+$/)){var n=Ea.exec(l.toLowerCase());if(null==n)l="";else{l=n[2];l=null==l||""==l?"n":Da[l];n=n[1];if(null==n||""==n)n="4";else var r=Ca[n],n=r?r:isNaN(n)?"4":n.substr(0,1);l=[l,n].join("")}}else l="";l&&g.push(l)}0<g.length&&(f=g);3==d.length&&(d=d[2],g=[],d=d?d.split(","):
	g,0<d.length&&(d=Ba[d[0]])&&(a.c[e]=d))}a.c[e]||(d=Ba[e])&&(a.c[e]=d);for(d=0;d<f.length;d+=1)a.a.push(new H(e,f[d]))}};function Ga(a,b){this.c=a;this.a=b}var Ha={Arimo:!0,Cousine:!0,Tinos:!0};Ga.prototype.load=function(a){var b=new C,c=this.c,d=new va(this.a.api,z(c),this.a.text),e=this.a.families;xa(d,e);var f=new Aa(e);Fa(f);A(c,za(d),D(b));F(b,function(){a(f.a,f.c,Ha)})};function Ia(a,b){this.c=a;this.a=b}Ia.prototype.load=function(a){var b=this.a.id,c=this.c.m;b?B(this.c,(this.a.api||"https://use.typekit.net")+"/"+b+".js",function(b){if(b)a([]);else if(c.Typekit&&c.Typekit.config&&c.Typekit.config.fn){b=c.Typekit.config.fn;for(var e=[],f=0;f<b.length;f+=2)for(var g=b[f],k=b[f+1],h=0;h<k.length;h++)e.push(new H(g,k[h]));try{c.Typekit.load({events:!1,classes:!1,async:!0})}catch(m){}a(e)}},2E3):a([])};function Ja(a,b){this.c=a;this.f=b;this.a=[]}Ja.prototype.load=function(a){var b=this.f.id,c=this.c.m,d=this;b?(c.__webfontfontdeckmodule__||(c.__webfontfontdeckmodule__={}),c.__webfontfontdeckmodule__[b]=function(b,c){for(var g=0,k=c.fonts.length;g<k;++g){var h=c.fonts[g];d.a.push(new H(h.name,ga("font-weight:"+h.weight+";font-style:"+h.style)))}a(d.a)},B(this.c,z(this.c)+(this.f.api||"//f.fontdeck.com/s/css/js/")+ea(this.c)+"/"+b+".js",function(b){b&&a([])})):a([])};var Y=new pa(window);Y.a.c.custom=function(a,b){return new ua(b,a)};Y.a.c.fontdeck=function(a,b){return new Ja(b,a)};Y.a.c.monotype=function(a,b){return new sa(b,a)};Y.a.c.typekit=function(a,b){return new Ia(b,a)};Y.a.c.google=function(a,b){return new Ga(b,a)};var Z={load:p(Y.load,Y)}; true?!(__WEBPACK_AMD_DEFINE_RESULT__ = function(){return Z}.call(exports, __webpack_require__, exports, module), __WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)):"undefined"!==typeof module&&module.exports?module.exports=Z:(window.WebFont=Z,window.WebFontConfig&&Y.load(window.WebFontConfig));}());


/***/ }

/******/ });