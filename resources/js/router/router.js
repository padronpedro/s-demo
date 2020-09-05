import VueRouter from 'vue-router'
// Pages
import Home from '../pages/Home'

// Admin
import HomeAdmin from '../pages/admin/Home'
import AdmMembers from '../pages/admin/members/AdmMembers'
import AddMember from '../pages/admin/members/AddEditMember'

import AdmClients from '../pages/admin/clients/AdmClients'
import AddClients from '../pages/admin/clients/AddEditClient'

import AdmProjects from '../pages/admin/projects/AdmProjects'
import AddProjects from '../pages/admin/projects/AddEditProject'

import NotFoundComponent from '../pages/NotFoundComponent'
// Client side
import ViewProject from '../pages/projects/ViewProject'
import ClientRequest from '../pages/projects/ClientRequest'

// Routes
const routes = [
	{
		path: '/',
		name: 'home',
		component: Home
	},
	// Admin section
	{
		path: '/admin',
		name: 'admin.home',
		component: HomeAdmin
    },
    {
		path: '/admin/members',
		name: 'admin.members',
		component: AdmMembers
	},
    {
		path: '/admin/members/add',
		name: 'admin.members.add',
		component: AddMember
	},
    {
		path: '/admin/members/edit/:id',
		name: 'admin.members.edit',
		component: AddMember
	},
    {
		path: '/admin/clients',
		name: 'admin.clients',
		component: AdmClients
	},
    {
		path: '/admin/clients/add',
		name: 'admin.clients.add',
		component: AddClients
	},
    {
		path: '/admin/clients/edit/:id',
		name: 'admin.clients.edit',
		component: AddClients
	},
    {
		path: '/admin/projects',
		name: 'admin.projects',
		component: AdmProjects
	},
    {
		path: '/admin/projects/add',
		name: 'admin.projects.add',
		component: AddProjects
	},
    {
		path: '/admin/projects/edit/:id',
		name: 'admin.projects.edit',
		component: AddProjects
    },
    // client side
    {
		path: '/view/:hash',
		name: 'client.project',
		component: ViewProject
    },
    {
		path: '/project',
		name: 'client.project.request',
		component: ClientRequest
	},
    {
      path: '*',
      component: NotFoundComponent
    }

]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router
