// TODO: THEME
import hooks from './hooks'
import { Application } from "stimulus"
import { definitionsFromContext } from "stimulus/webpack-helpers"
import loaded from './loaded'

const application = Application.start()
const context = require.context("./controllers", true, /\.js$/)


loaded( function() {
	hooks(document)
	application.load(definitionsFromContext(context))
})

