Futibasclube::Application.routes.draw do
  root 'main#index'

  get "main/index"
  
  get "partida/:partida_id/gera_equipes"  => 'partidas#gera_equipes'
  get "partida/:partida_id/salva_equipes" => 'partidas#salva_equipes'
  resources :partidas
  
  get  "usuarios/login"                   => 'usuarios#login_after_cadastro'
  post "usuarios/login"
  get  "usuario/logoff"                   => 'usuarios#logoff'
  get  "gerente/novo"                     => 'usuarios#new'
  post "usuarios/create"                  => 'usuarios#create'
  resources :usuarios
  
  get  "partida/:partida_id/jogadores/"     => 'jogadors#index'
  get  "partida/:partida_id/jogador/novo"   => 'jogadors#new'
  resources :jogadors

  
  # The priority is based upon order of creation: first created -> highest priority.
  # See how all your routes lay out with "rake routes".

  # You can have the root of your site routed with "root"
  # root 'welcome#index'

  # Example of regular route:
  #   get 'products/:id' => 'catalog#view'

  # Example of named route that can be invoked with purchase_url(id: product.id)
  #   get 'products/:id/purchase' => 'catalog#purchase', as: :purchase

  # Example resource route (maps HTTP verbs to controller actions automatically):
  #   resources :products

  # Example resource route with options:
  #   resources :products do
  #     member do
  #       get 'short'
  #       post 'toggle'
  #     end
  #
  #     collection do
  #       get 'sold'
  #     end
  #   end

  # Example resource route with sub-resources:
  #   resources :products do
  #     resources :comments, :sales
  #     resource :seller
  #   end

  # Example resource route with more complex sub-resources:
  #   resources :products do
  #     resources :comments
  #     resources :sales do
  #       get 'recent', on: :collection
  #     end
  #   end

  # Example resource route with concerns:
  #   concern :toggleable do
  #     post 'toggle'
  #   end
  #   resources :posts, concerns: :toggleable
  #   resources :photos, concerns: :toggleable

  # Example resource route within a namespace:
  #   namespace :admin do
  #     # Directs /admin/products/* to Admin::ProductsController
  #     # (app/controllers/admin/products_controller.rb)
  #     resources :products
  #   end
end
