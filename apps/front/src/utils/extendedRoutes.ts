import { resolve } from 'path';
import { RouteType } from '../types/ExtendedRoute'

// Helper function to resolve the path of pages
const resolvePath = (pageName: string): string => {
  return resolve(__dirname, `../pages/${pageName}`);
};

// Extended route function with proper typing
const extendedRoutes = (routes: RouteType[]): RouteType[] => {
  routes.push({
    name: 'payment-add',
    path: '/payment/add',
    file: resolvePath('payments/[id].vue'),
  });
  
  routes.push({
    name: 'payment-edit',
    path: '/payment/edit',
    file: resolvePath('payments/[id].vue'),
  });
  
  return routes;
}

export default extendedRoutes;
