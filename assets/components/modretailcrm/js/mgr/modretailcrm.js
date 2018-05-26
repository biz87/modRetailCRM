var modretailcrm = function (config) {
	config = config || {};
	modretailcrm.superclass.constructor.call(this, config);
};
Ext.extend(modretailcrm, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('modretailcrm', modretailcrm);

modretailcrm = new modretailcrm();