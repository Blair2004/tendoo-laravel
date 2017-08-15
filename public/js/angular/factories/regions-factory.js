tendooApp.factory( 'sharedRegions', function( namespace ){
	this.regions = [
		{
			namespace :    "cameroon",
		 	regions   :    {
		 		{
		 			key   :   "center",
		 			value :   "center"
		 		},
		 		{
		 			key   :   "littoral",
		 			value :   "littoral"
		 		},
		 		{
		 			key   :   "east",
		 			value :   "east"
		 		}
		 	}
		}
	];
	return this.regions[namespace].regions;
})